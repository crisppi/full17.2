// ****************************************** //
// PEGAR DADOS DOS INPUTS //    
// ****************************************** //

let inputEnf = document.getElementById("valor_glosa_enf");
let inputMed = document.getElementById("valor_glosa_med");
let inputApresent = document.getElementById("valor_apresentado_capeante");
let valorFinal = document.getElementById("valor_final_capeante");

let data_inicial_capeante = document.getElementById("data_inicial_capeante");
let data_final_conta = document.getElementById("data_final_conta");
let dataInt = document.getElementById("data_intern_int");
let diarias = document.getElementById("diarias_capeante");

// ****************************************** //
// METODO DE VERIFICAR DATAS DO CAPEANTE //
// ****************************************** //

// ********** INICIO VERIFICAR DATA INICIAL ********  // 
data_inicial_capeante.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE
        let dataInicConta = document.getElementById("data_inicial_capeante");
        dataInicContaV = dataInicConta.value;

        let dataInt = document.getElementById("data_intern_int");
        dataIntV = dataInt.value;

        dataInicContaDao = new Date(dataInicContaV);
        dataIntVDao = new Date(dataIntV);

        var diaInt = (dataIntVDao.getUTCDate());
        var diaIni = (dataInicContaDao.getUTCDate());

        var dif1 = diaIni < diaInt; // ver se a data inicial da prorrogacao é menor que a data da internacao

        var divMsg = document.querySelector("#notif-input");

        if (dif1 === false) {
            divMsg.style.display = "block";
            dataInicConta.style.borderColor = "red";
            dataInicConta.value = "";
            dataInicConta.focus();

        } else {
            divMsg.style.display = "none";
            dataInicConta.style.borderColor = "gray";

        }

    })
    // ********* FIM VERIFICAR DATA INICIAL ********// 



// ********** INICIO VERIFICAR DATA FINAL ********  // 

// notificacao de data final menor q data internacao e data inicial
data_final_conta.addEventListener("blur", function() {
        // notificacao de data final menor q data internacao e maior q data inicial
        let dataInicConta = document.getElementById("data_inicial_capeante");
        dataInicContaV = dataInicConta.value;

        let dataInt = document.getElementById("data_intern_int");
        dataIntV = dataInt.value;

        let dataFinalConta = document.getElementById("data_final_conta");
        dataFinalContaV = dataFinalConta.value;

        let diarias = document.getElementById("diarias_capeante");
        diariasV = diarias.value;

        dataIntVDao = new Date(dataIntV);
        dataInicContaDao = new Date(dataInicContaV);
        dataFinalContaDao = new Date(dataFinalContaV);

        var diaInt = (dataIntVDao.getUTCDate());
        var diaIni = (dataInicContaDao.getUTCDate());
        var diaFin = (dataFinalContaDao.getUTCDate());

        var dif1 = diaIni > diaInt; // ver se a data inicial da prorrogacao é menor que a data da internacao
        var dif2 = diaIni < diaFin; // ver se a data inicial da prorrogacao é menor que a data final da prorrogacao

        var divMsg2 = document.querySelector("#notif-input2");

        if (dif2 === false && dif1 === false) {
            divMsg2.style.display = "block";
            dataFinalConta.style.borderColor = "red";
            dataFinalConta.value = "";
            dataFinalConta.focus();

        } else {
            divMsg2.style.display = "none";
            dataFinalConta.style.borderColor = "gray";
            diarias.value = diaFin - diaIni;
        }
    })
    // ********** FIM VERIFICAR DATA FINAL ********  // 


// console.log(`${dataInicContaDao.getUTCFullYear()}-${(dataInicContaDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataInicContaDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
// console.log(`${dataFechVDao.getUTCFullYear()}-${(dataFechVDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataFechVDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
// console.log(`${dataIntVDao.getUTCFullYear()}-${(dataIntVDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataIntVDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01

// console.log("dia ini" + diaIni);
// console.log("dia fin" + diaFin);
// console.log("dia inter" + diaInt);


// console.log(data.getUTCFullYear());
// console.log(data.getUTCMonth() + 1);
// console.log(data.getUTCDate());
// var diaFech = (dataAtual.getUTCDate());

// console.log(diaCap - diaFech);

// console.log(dataAtual.getUTCDate());