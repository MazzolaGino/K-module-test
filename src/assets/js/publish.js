class SharePostPublishing {

    #message;

    init() {

        this.error();

        if (this.can()) {
            this.activate();
        } else {
            this.deactivate();
        }

        const param = this;


        document.getElementById('publish').addEventListener('click', function (event) {
            if (!param.can()) {
                event.preventDefault();
                param.deactivate();
                return false;
            }
        });

        document.getElementById('texte_twitter').addEventListener('input', function () {
            param.evaluate('texte_twitter');
        });

        document.getElementById('texte_facebook').addEventListener('input', function () {
            param.evaluate('texte_facebook');
        });

        document.getElementById('texte_discord').addEventListener('input', function () {
            param.evaluate('texte_discord');
        });

    }

    error() {

        this.#message = document.createElement('div');
        this.#message.classList.add('error', 'below-h2');
        this.#message.innerHTML = '<p>Les champs personnalisés texte_twitter, texte_facebook et texte_discord sont obligatoires.</p>';

        document.getElementById('titlediv').after(this.#message);
    }

    activate() {
        document.getElementById('publish').disabled = false;
        this.#message.style.display = 'none';
    }

    deactivate() {
        document.getElementById('publish').disabled = true;
        this.#message.style.display = 'block';
    }

    can() {
        return document.getElementById('texte_twitter').value !== ''
            && document.getElementById('texte_facebook').value !== ''
            && document.getElementById('texte_discord').value !== ''
    }

    evaluate(name) {
        if (document.getElementById(name).innerHTML === "") {
            this.deactivate();
        } else if (this.can()) {
            this.activate();
        } else {
            this.deactivate();
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Le code à exécuter une fois que le document est prêt
    const share = new SharePostPublishing();
    share.init();

});