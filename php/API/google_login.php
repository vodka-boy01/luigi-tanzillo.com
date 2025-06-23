<?php
header('Content-Type: application/json');
session_start();

require_once __DIR__ . "/../query/database.php";
require_once __DIR__ . "/../query/user.php";
require_once __DIR__ . "/../protected/minimum_authorization_level.php";

$input = file_get_contents('php://input');
$userData = json_decode($input, true);

if (!$userData || empty($userData['google_id']) || empty($userData['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Dati non validi']);
    exit;
}

try {
    $conn = (new database())->connect();
    $userOperations = new user($conn);

    $googleId = $userData['google_id'];
    $email = $userData['email'];
    $name = $userData['name'] ?? '';
    $surname = $userData['surname'] ?? '';
    $username = $userData['username'] ?? '';

    $existingUser = getUserByEmailOrGoogleId($conn, $email, $googleId);

    if ($existingUser) {
        updateGoogleUser($conn, (int)$existingUser['id'], $googleId);
        setUserSession($existingUser, $userOperations);
        updateLastLogin($conn, $existingUser['username']);
    } else {
        $finalUsername = generateUniqueUsername($conn, $username, $email);
        $regResult = registerGoogleUser($conn, [
            'google_id' => $googleId,
            'name' => $name,
            'surname' => $surname,
            'username' => $finalUsername,
            'email' => $email
        ]);
        if (!$regResult['success']) {
            throw new Exception($regResult['message']);
        }
        setUserSession([
            'username' => $finalUsername,
            'name' => $name,
            'ruolo' => USER_AUTHORIZATION_LEVEL,
        ], $userOperations, true);
    }

    $conn->close();

    echo json_encode([
        'success' => true,
        'message' => 'Login con Google completato con successo',
        'redirect' => '/index.php'
    ]);
} catch (Exception $e) {
    if (isset($conn)) $conn->close();
    error_log("Errore Google Login: " . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Errore interno del server durante il login: ' . $e->getMessage()
    ]);
}

// FUNZIONI

function getUserByEmailOrGoogleId($conn, $email, $googleId)
{
    $query = "SELECT * FROM utenti WHERE email = '$email' OR google_id = '$googleId' LIMIT 1";
    $result = $conn->query($query);
    return ($result && $result->num_rows) ? $result->fetch_assoc() : null;
}

function updateGoogleUser($conn, int $userId, string $googleId)
{
    $userId = (int)$userId;
    $query = "UPDATE utenti SET google_id = '$googleId', auth_provider = 'google' WHERE id = $userId";
    return $conn->query($query);
}

function updateLastLogin($conn, $username)
{
    $now = date('Y-m-d H:i:s');
    $query = "UPDATE utenti SET latest_login = '$now' WHERE username = '$username'";
    return $conn->query($query);
}

function generateUniqueUsername($conn, $preferred, $email)
{
    $clean = preg_replace('/[^a-zA-Z0-9_]/', '', $preferred);
    if ($clean && !usernameExists($conn, $clean)) return $clean;

    $base = preg_replace('/[^a-zA-Z0-9_]/', '', explode('@', $email)[0]);
    if (!usernameExists($conn, $base)) return $base;

    for ($i = 1; $i < 1000; $i++) {
        $try = $base . $i;
        if (!usernameExists($conn, $try)) return $try;
    }

    return $base . uniqid();
}

function usernameExists($conn, $username)
{
    $query = "SELECT id FROM utenti WHERE username = '$username' LIMIT 1";
    $result = $conn->query($query);
    return $result && $result->num_rows > 0;
}

function registerGoogleUser($conn, $data)
{
    $query = "INSERT INTO utenti (google_id, name, surname, username, email, password, avatar, ruolo, auth_provider) 
              VALUES ('{$data['google_id']}', '{$data['name']}', '{$data['surname']}', '{$data['username']}', '{$data['email']}', '', NULL, " . USER_AUTHORIZATION_LEVEL . ", 'google')";

    if ($conn->query($query)) {
        return ['success' => true, 'user_id' => $conn->insert_id];
    }
    return ['success' => false, 'message' => 'Errore durante la registrazione: ' . $conn->error];
}

function setUserSession($user, $userOperations, $isNewUser = false)
{
    $_SESSION['username'] = $user['username'];
    $_SESSION['nome'] = $user['name'] ?? '';
    $_SESSION['google_login'] = true;

    if ($isNewUser) {
        $_SESSION['ruoloId'] = USER_AUTHORIZATION_LEVEL;
        $_SESSION['ruolo'] = USER_AUTHORIZATION_LEVEL_NAME;
    } else {
        $_SESSION['ruoloId'] = $user['ruolo'];
        $_SESSION['ruolo'] = $userOperations->getUserRole($user['username']);
    }
}
