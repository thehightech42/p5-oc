/**
 * Link in head the stylesheet of bootstrap
 * 
 * idForm = l'ID of form, like ## document.getElementById('');
 * idFieldPassword = l'id of the first field of password, like l'ID of form, like ## document.getElementById('');
 * idFieldPassword1 = l'id of the second field of password, like l'ID of form, like ## document.getElementById('');
 */
class ControlePassword{
    constructor(idForm, idFieldPassword, idFieldPassword1){
        this.idForm = idForm;
        this.idFieldPassword = idFieldPassword;
        this.idFieldPassword1 = idFieldPassword1;
        this.addListerner();
        this.stopSent();
    }
    /**
     * Add listener on the second field of password
     */
    addListerner(){
        this.idFieldPassword1.addEventListener('input', this.password.bind(this))
    }
    /**
     * Check and add or remove bootstrap class
     */
    password(){
        if(this.idFieldPassword.value !== this.idFieldPassword1.value){
            this.idFieldPassword.classList.remove('is-valid');
            this.idFieldPassword1.classList.remove('is-valid');

            this.idFieldPassword.classList.add('is-invalid');
            this.idFieldPassword1.classList.add('is-invalid');
        }else{
            this.idFieldPassword.classList.remove('is-invalid');
            this.idFieldPassword1.classList.remove('is-invalid');

            this.idFieldPassword.classList.add('is-valid');
            this.idFieldPassword1.classList.add('is-valid');
        }
        this.idFieldPassword1.removeEventListener('change', this.password.bind(this));
        this.addListerner();
    }
    /**
     * Add a listener for check before sending form. 
     */
    stopSent(){
        this.idForm.addEventListener('submit', this.checkSubmit.bind(this));
    }
    /**
     * If the checking is not good, the form can not send.
     * @param {*} e Event
     */
    checkSubmit(e){
        if(this.idFieldPassword.value !== this.idFieldPassword1.value) {
            e.preventDefault();
            this.idForm.removeEventListener('submit', this.checkSubmit.bind(this));
            this.stopSent();
        }
    }

}