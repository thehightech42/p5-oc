class AmortizationTable{
    constructor(idBlockForm, idBlockTab){
        this.idBlockForm = document.getElementById(idBlockForm);
        this.idBlockTab = document.getElementById(idBlockTab); 
        this.mensualite = 0;
        this.coutCredit = 0;
        this.duration = 0; 
        this.rate = 0;
        this.capital = 0;

        this.contrucFormulaire('formOfAmortization');
        this.eventButtonCheckForm();

        let blocInfos = this.createBlocInfo();
        this.idBlockForm.appendChild(blocInfos);         
    }

    contrucFormulaire(idFormulaire){
        let form = document.createElement('form');
        let title = document.createElement('h4'); 
        title.textContent = "Informations du prêt"; 
        this.idBlockForm.appendChild(title);
        form.setAttribute('id', idFormulaire ); 

        let blocCapital= this.createBlocElementForm('blocCapital', 'false', 'capital', 'Montant à emprunter : ', 'number', 10000);
        let blocRate = this.createBlocElementForm('blocRate', 'false', 'rate', 'Taux d\'intérêt : ', 'number', 0.5, 5, 0.01);
        let blocDuration = this.createBlocElementForm('blocDuration', 'false', 'duration', 'Durée de l\'emprunt : ', 'select', 2);
        let button = this.createButton();

        form.appendChild(blocCapital);
        form.appendChild(blocRate);
        form.appendChild(blocDuration);

        let blocButton = this.createDiv();
        blocButton.appendChild(button);
        form.appendChild(blocButton);

        this.idBlockForm.appendChild(form);
        
        //Style du formulaire
        form.style.display="flex";
        if(window.matchMedia("(min-width: 640px)").matches){
            form.style.flexDirection = "row";
            form.style.justifyContent = "space-between";
        }else{
            form.style.flexDirection = "column";
            form.style.justifyContent = "space-between";
        }
    }
   /**
    * Methode qui crée des bloc du champs de formulaire
    * Champs avec *#* sont des champs obligatoire les autres peuvent etre remplacé par "false"; 
    * @param {*} idDiv idDiv Nom de la div *#*
    * @param {*} classDiv 
    * @param {*} idInputAndNameAndLabel idInputAndNameAndLabel Nom de l'ID pour l'INPUT, le NAME & le LABEL *#*
    * @param {*} contentLabel contentLabel Contenu du LABEL *#*
    * @param {*} typeElement typeElement Le type de L'element ou de l'input *#*
    * @param {*} min 
    * @param {*} max 
    * @param {*} step 
    */
    createBlocElementForm(idDiv, classDiv, idInputAndNameAndLabel, contentLabel, typeElement, min = false, max = false, step = false){
        let bloc = this.createDiv(idDiv);
        bloc.setAttribute('id', idDiv); 
        if(classDiv !== false){
            bloc.setAttribute('class', classDiv); 
        }

        let label = this.createLabel(idInputAndNameAndLabel, contentLabel);

        let fields = 0;
        if(typeElement === "select"){
            fields = this.createSelectDuration(idInputAndNameAndLabel, min);
        }else{
            fields= this.createInput(idInputAndNameAndLabel, typeElement, min, max , step);
        }
        fields.style.textAlign ="right";
        
        let underBloc = this.createDiv();
        underBloc.appendChild(fields);

        let span = document.createElement('span')
        if(idInputAndNameAndLabel === "capital"){
            span.textContent = " €";
        }
        if(idInputAndNameAndLabel === "rate"){
            span.textContent = " %";
        }
        underBloc.appendChild(span);
        label.appendChild(underBloc);

        bloc.appendChild(label);
        return bloc;
    }

    createDiv(id = false){
        let element = document.createElement('div'); 
        element.style.display = "inline-block";
        element.style.textAlign ="center";
        if(id !== false){
            element.setAttribute('id',id);
        }
        element.style.width = "100%";
        element.style.margin = "auto";
        return element; 
    }

    createInput(id, type, min = false, max = false, step = false){
        let element = document.createElement('input');
        element.setAttribute('id', id);
        element.setAttribute('type', type);
        element.setAttribute('required', "");
        element.setAttribute('class', 'form-perso');
        if(min !== false && type === "number"){
            element.setAttribute('min', min);
        }
        if(max !== false && type === "number"){
            element.setAttribute('max', max)
        }
        if(step !== false){
            element.setAttribute('step', step); 
        }

        return element;
    }

    createLabel(id, content){
        let element = document.createElement('label'); 
        element.setAttribute('for', id); 
        element.textContent = content;
        element.style.width = "100%";
        return element;
    }

    createSelectDuration(id, yearsMin){
        let element = document.createElement('select'); 
        element.setAttribute('id', id);
        element.setAttribute('class', 'form-perso');
            for(let i = yearsMin; i <= 30; i++){
                let option = document.createElement('option'); 
                option.setAttribute('value', i);
                option.textContent = i + " ans"; 
                element.appendChild(option); 
            }
        return element; 
    }

    createButton(){
        let element = document.createElement('input');
        element.setAttribute('type', 'submit'); 
        element.setAttribute('id', 'checkForm'); 
        element.setAttribute('class', 'form-perso');
        element.setAttribute('value', 'Générer'); 
        return element; 
    }

    eventButtonCheckForm(){
        let form = document.getElementById('formOfAmortization'); 
        form.addEventListener('submit', this.actionEventButton.bind(this)); 
    }

    actionEventButton(e){
        e.preventDefault();
        let button = document.getElementById('checkForm'); 

        this.capital = document.getElementById('capital').value; 
        this.rate = document.getElementById('rate').value;
        this.duration = document.getElementById('duration').value;  

        if(button.value === "Générer"){
            button.setAttribute('value', 'Reset');
            this.calculation();
            this.generateTab();
        }
        else{
            button.setAttribute('value', 'Générer');
            document.getElementById('capital').value = ""; 
            document.getElementById('rate').value = "";
            document.getElementById('duration').value = "";
            this.mensualite = 0;
            this.coutCredit = 0;
            document.getElementById('pmensualite').textContent ="La mensualité est de : " + this.mensualite + " €";
            document.getElementById('pCoutCredit').textContent ="Le cout du crédit est de  : " + this.coutCredit + " €"; 
            this.duration = 0;
            this.rate = 0;
            this.capital = 0; 
            this.idBlockTab.textContent = "";
             
        }
    }

    /**
     * Cette méthode calcul la mensualité, le cout du crédit et les affaiches. 
     */
    calculation(){
        let durationMonth = this.duration *12; 
        console.log("Le montant emprunté est de " + this.capital + "€ sur une durée de " + durationMonth + " mois à un taux de " + this.rate +"% !" );
        this.rate = this.rate/100;
        
        this.mensualite = (this.capital *(this.rate/12)) / (1- Math.pow((1+(this.rate/12)), -durationMonth));
        this.coutCredit = (this.mensualite*durationMonth)-this.capital;
        console.log('La mensualité est de : ' +  + "€ ");
        document.getElementById('pmensualite').textContent ="La mensualité est de : " + this.mensualite.toFixed(2) + " €";
        document.getElementById('pCoutCredit').textContent ="Le cout du crédit est de  : " + this.coutCredit.toFixed(2) + " €"; 

    }

    createBlocInfo(){
        let blocInfos = document.createElement('div'); 
        blocInfos.setAttribute('id', 'blocInfos');
        blocInfos.classList.add('mt-3');

        let pMensualite = this.createP("pmensualite");
        let pCoutCredit = this.createP('pCoutCredit'); 

        blocInfos.appendChild(pMensualite);
        blocInfos.appendChild(pCoutCredit);
        return blocInfos;
    }

    createP(id){
        let p = document.createElement('p'); 
        p.setAttribute('id', id);
        if(id === "pmensualite"){
            p.textContent ="La mensualité est de : " + this.mensualite + " €";
        }else{
            p.textContent ="Le cout du crédit est de : " + this.coutCredit + " €"; 
        }
         
        return p; 
    }

    generateTab(){
        let mensualite = this.mensualite;
        let coutCredit  = this.coutCredit;
        let duration =this.duration; 
        let rate = this.rate;
        let capital = this.capital;

        let blocTab = document.createElement('div');
        blocTab.setAttribute('id', 'blocTab'); 

        this.idBlockTab.appendChild(blocTab); 
        let title = document.createElement('h4');
        title.textContent = "Tableau d'amortissement"; 
        blocTab.appendChild(title); 

        let array = document.createElement('table'); 
        let ligneOne = document.createElement('tr');
        let number = this.createTd('Echéance', ligneOne);
        let capitalHead = this.createTd('Capital', ligneOne);
        let mensualiteHead = this.createTd('Mensualité', ligneOne);
        let intérêtHead = this.createTd('Interêt', ligneOne);
        let partDuCapitalHead = this.createTd('Part du capital', ligneOne);
        let capitalRestantDuHead = this.createTd('Capital restant du', ligneOne);

        array.appendChild(ligneOne);
        blocTab.appendChild(array);

        //Contenu

        for(var i = 1; i<=this.duration*12; i++){
            let ligne = document.createElement('tr'); 

            let number = this.createTd(i, ligne);
            let cellCapital = this.createTd(parseFloat(capital).toFixed(2), ligne, " €");
            let cellMensualite = this.createTd(mensualite.toFixed(2), ligne, " €");
            let interest = capital * (this.rate/12);
            let cellInterest = this.createTd(interest.toFixed(2), ligne, " €");
            let partCapital = this.mensualite - interest; 
            let cellPartCapital = this.createTd(partCapital.toFixed(2), ligne, " €");
            capital = capital-partCapital;
            let cellCapitalRestant = this.createTd(parseFloat(capital).toFixed(2), ligne, " €");

            array.appendChild(ligne);
        }

    }

    createTd(content, ligne, type = 0){
        let element = document.createElement('td');
        if(type !== 0){
            element.textContent = content + type;
        }else{
            element.textContent = content;
        }
        ligne.appendChild(element);
    }

}