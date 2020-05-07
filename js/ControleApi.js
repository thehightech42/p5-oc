class ControleApi{
    /**
     * Information of params
     * @param {*} idForm  id of form where you get the credit information.
     * @param {*} idFortab id of div where would you like generate the tab.
     * @param {*} key key for use the api
     * @param {*} tab bool for indicate if you would like generate or not the amortization tab directle after the request.
     * For display monthly payment and cost of credit, place span on you page with id "mensualite" for montly payment and with id "creditCost" for cost of credit.
     */
   constructor(idForm, idFortab, key, tab){
        this.idForm = document.getElementById(idForm);
        this.idFortab = document.getElementById(idFortab);
        this.key = key;

        this.capital = 0;
        this.rate = 0;
        this.duration = 0; 
        this.durationMonth = 0;

        this.idForm.addEventListener('submit', (e)=>{
            e.preventDefault();

            this.capital = document.getElementById('capital').value;
            this.rate = document.getElementById('rate').value;
            this.duration = document.getElementById('duration').value;
    
            ajaxGet("https://apicredit.antoninpfistner.fr/?duration="+this.duration+"&rate="+this.rate+"&capital="+this.capital+"&key="+this.key, (reponse)=>{
                this.idFortab.textContent = "";
                let response = JSON.parse(reponse);
                this.displayInformation(response);
                if(tab === true){
                    this.generateTab(response);
                }
            });
        });
    }

    displayInformation(reponse){
        console.log(reponse);
        document.getElementById('mensualite').textContent = reponse.resultat['mensualite'];
        document.getElementById('creditCost').textContent = reponse.resultat['creditCost'];
    }

    generateTab(reponse){
        let mensualite = reponse.resultat['mensualite'];
        let coutCredit  = reponse.resultat['creditCost'];
        let duration = this.duration; 
        let rate = this.rate;
        let capital = this.capital;

        let blocTab = document.createElement('div');
        blocTab.setAttribute('id', 'blocTab'); 

        this.idFortab.appendChild(blocTab); 
        let title = document.createElement('h4');
        title.textContent = "Tableau d'amortissement"; 
        blocTab.appendChild(title); 

        let array = document.createElement('table'); 

        blocTab.appendChild(array);

        //Contenu
        let elementTable = reponse.resultat['table'];
        console.log(elementTable);
        for(var i = 0; i<=this.duration*12; i++){
            
            let ligne = document.createElement('tr'); 
            if(i === 0){
                let number = this.createTd(elementTable[i][0], ligne);
                let cellCapital = this.createTd(elementTable[i][1], ligne);
                let cellMensualite = this.createTd(elementTable[i][2], ligne);
                let cellInterest = this.createTd(elementTable[i][3], ligne);
                let cellPartCapital = this.createTd(elementTable[i][4], ligne);
                let cellCapitalRestant = this.createTd(elementTable[i][5], ligne);
            }else{
                let number = this.createTd(elementTable[i][0], ligne);
                let cellCapital = this.createTd(elementTable[i][1].toFixed(2), ligne, " €");
                let cellMensualite = this.createTd(elementTable[i][2].toFixed(2), ligne, " €");
                let cellInterest = this.createTd(elementTable[i][3].toFixed(2), ligne, " €");
                let cellPartCapital = this.createTd(elementTable[i][4].toFixed(2), ligne, " €");
                let cellCapitalRestant = this.createTd(elementTable[i][5].toFixed(2), ligne, " €");
    
            }
            
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