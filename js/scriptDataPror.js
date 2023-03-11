// ****************************************** //
// PEGAR DADOS DOS INPUTS //    
// ****************************************** //

let dataIntP = document.getElementById("data_inter_int2");

let dataPro = document.getElementById("prorrog1_ini_pror");
let dataProF = document.getElementById("prorrog1_fim_pror");

let dataPro2 = document.getElementById("prorrog2_ini_pror");
let dataProF2 = document.getElementById("prorrog2_fim_pror");

let dataPro3 = document.getElementById("prorrog3_ini_pror");
let dataProF3 = document.getElementById("prorrog3_fim_pror");

// ********** INICIO VERIFICACAO DATA INTERNACAO E DATA INICIAL PRORROGACAO 1********  // 
dataPro.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE

        // let dataInt = document.getElementById("data_intern_int");
        let dataPro = document.getElementById("prorrog1_ini_pror");

        dataIntV1 = dataIntP.value;
        dataProV = dataPro.value;

        dataIntVDao = new Date(dataIntV1);
        dataProDao = new Date(dataProV);

        var dataIntV1 = (dataIntVDao.getUTCDate());
        var dataProV = (dataProDao.getUTCDate());

        var dif11 = dataIntV1 < dataProV; // ver se a data inicial da prorrogacao é menor que a data da internacao
        var divMsg1 = document.querySelector("#notif-input1");

        if (dif11 === true) {
            divMsg1.style.display = "block";
            dataPro.style.borderColor = "red";
            dataPro.value = "";
            dataPro.focus();

        } else {
            divMsg1.style.display = "none";
            dataPro.style.borderColor = "gray";

        }

    })
    // ********** FIM VERIFICACAO DATA INTERNACAO E DATA INICIAL PRORROGACAO 1  ********  // 


// ********** INICIO VERIFICACAO DATA FINAL PRORROGACAO 1 COM DATA INICIAL PRORROGACAO 1 ********  // 
dataProF.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE

        let dataPro = document.getElementById("prorrog1_ini_pror");
        let dataProF = document.getElementById("prorrog1_fim_pror");

        dataProV = dataPro.value;
        dataProVF = dataProF.value;

        dataProDao = new Date(dataProV);
        dataProFDao = new Date(dataProVF);

        var dataProV = (dataProDao.getUTCDate());
        var dataProVF = (dataProFDao.getUTCDate());

        var dif12 = dataProV < dataProVF; // ver se a data inicial da prorrogacao é menor que a data da internacao
        var divMsg2 = document.querySelector("#notif-input2");

        if (dif12 === false) {
            divMsg2.style.display = "block";
            dataProF.style.borderColor = "red";
            dataProF.value = "";
            dataProF.focus();

        } else {
            divMsg2.style.display = "none";
            dataProF.style.borderColor = "gray";

        }
    })
    // ********** FIM VERIFICACAO DATA FINAL PRORROGACAO 1 COM DATA INICIAL PRORROGACAO 1 ********  //


// ********** INICIO VERIFICACAO DATA INICIAL PRORROGACAO 2 COM DATA FINAL PRORROGACAO 1 ********  // 
dataPro2.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE

        let dataProF = document.getElementById("prorrog1_fim_pror");
        let dataPro2 = document.getElementById("prorrog2_ini_pror");

        dataProFV2 = dataProF.value;
        dataPro2V = dataPro2.value;

        dataProFV2Dao = new Date(dataProVF2);
        dataPro2Dao = new Date(dataPro2V);

        var dataProVF2 = (dataProFV2Dao.getUTCDate());
        var dataProV2 = (dataPro2Dao.getUTCDate());

        var dif13 = dataProV2 < dataProVF2; // ver se a data inicial da prorrogacao é menor que a data da internacao
        var divMsg3 = document.querySelector("#notif-input3");

        if (dif13 === true) {
            divMsg3.style.display = "block";
            dataPro2.style.borderColor = "red";
            dataPro2.value = "";
            dataPro2.focus();

        } else {
            divMsg3.style.display = "none";
            dataPro2.style.borderColor = "gray";

        }
    })
    // ********** FIM VERIFICACAO DATA INICIAL PRORROGACAO 2 COM DATA FINAL PRORROGACAO 1 ********  //