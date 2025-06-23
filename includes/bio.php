<style>
    #bio-tab {
        display: grid;
        grid-template-columns: minmax(150px, 300px) 1fr;
        align-items: center;
        gap: 30px;
        padding: 20px;
    }

    #tanzillo {
        width: 100%;
        border-radius: 15px;
        object-fit: cover;
    }

    .text-box {
        max-width: 100%;
    }

    #title {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    /* Tablet e medio schermo */
    @media (max-width: 768px) {
        #bio-tab {
            grid-template-columns: 1fr 2fr;
        }

        #title {
            font-size: 2rem;
        }

        h3 {
            font-size: 1rem;
        }
    }

    /* Smartphone piccoli: 390px */
    @media (max-width: 430px) {
        #bio-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        #tanzillo {
            padding-top: 100px;
            max-width: 80%;
        }

        .text-box {
            max-width: 90%;
        }

        #title {
            font-size: 1.8rem;
        }

        h3 {
            font-size: 0.95rem;
            line-height: 1.4em;
        }
    }
</style>

<div id="bio-tab">
    <img src="/../assets/img/luigi.PNG" alt="Errore" id="tanzillo">
    <div class="text-box">
        <h1 id="title">Luigi Tanzillo</h1>
        <h3>
            Benvenuto sul mio web portfolio. <br>
            Potrai trovare tutti i miei progetti e conoscenze <br>
            Assieme ad una vasta gamma di esperienze personali e progetti<br>
            Scopri come unisco passione e competenze tecniche nel mio lavoro <br>
            Ogni progetto racconta un percorso di crescita e dedizione <br>
            Naviga tra le sezioni per saperne di più su di me.
        </h3>
    </div>
</div>
