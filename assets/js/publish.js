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

        document.getElementById('texte_twitter').addEventListener('keydown', function () {
            param.evaluate();
        });

        document.getElementById('texte_facebook').addEventListener('keydown', function () {
            param.evaluate();
        });

        document.getElementById('texte_discord').addEventListener('keydown', function () {
            param.evaluate();
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
        
        var ok = document.getElementById('texte_twitter').value !== ''
            && document.getElementById('texte_facebook').value !== ''
            && document.getElementById('texte_discord').value !== '';

        console.log('tu peux publier ?' + ok);

        return ok;
    }

    evaluate() {

        console.log(this.can());

        if (this.can()) {
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