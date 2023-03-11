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

        let dataPro2 = document.getElementById("prorrog1_ini_pror");
        let dataProF = document.getElementById("prorrog1_fim_pror");

        dataProV = dataPro2.value;
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

        let dataProFb = document.getElementById("prorrog1_fim_pror");
        console.log(dataProFb);
        let dataPro2 = document.getElementById("prorrog2_ini_pror");

        dataProFV2 = dataProFb.value;
        dataPro2V = dataPro2.value;
        console.log(dataProFV2);
        console.log(dataPro2V);

        dataProFV2Dao = new Date(dataProFV2);
        dataPro2Dao = new Date(dataPro2V);

        var dataProVF2 = (dataProFV2Dao.getUTCDate());
        var dataProV2 = (dataPro2Dao.getUTCDate());

        console.log(dataProVF2);
        console.log(dataProV2);

        var dif13 = dataProV2 < dataProVF2; // ver se a data inicial da prorrogacao2 é menor que a data da prorrogacao1
        console.log(dif13);

        var divMsg3 = document.querySelector("#notif-input3");

        if (dif13 === true) {
            console.log(dif13);
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

// ********** INICIO VERIFICACAO DATA FINAL PRORROGACAO 2 COM DATA INICIAL PRORROGACAO 2 ********  // 
dataProF2.addEventListener("blur", function() {

        let dataProF2 = document.getElementById("prorrog2_fim_pror");
        let dataPro2B = document.getElementById("prorrog2_ini_pror");

        dataProFV2B = dataProF2.value;
        dataPro2VB = dataPro2B.value;
        console.log(dataProFV2B);
        console.log(dataPro2VB);

        dataProFV2BDao = new Date(dataProFV2B);
        dataPro2BDao = new Date(dataPro2VB);

        var dataProVF2B = (dataProFV2BDao.getUTCDate());
        var dataProV2B = (dataPro2BDao.getUTCDate());

        console.log(dataProVF2B);
        console.log(dataProV2B);

        var dif14 = dataProV2B < dataProVF2B; // ver se a data inicial da prorrogacao2 é menor que a data da prorrogacao1
        console.log(dif14);

        var divMsg4 = document.querySelector("#notif-input4");

        if (dif14 === false) {
            console.log(dif14);
            divMsg4.style.display = "block";
            dataProF2.style.borderColor = "red";
            dataProF2.value = "";
            dataProF2.focus();

        } else {
            divMsg4.style.display = "none";
            dataProF2.style.borderColor = "gray";

        }
    })
    // ********** FIM VERIFICACAO DATA FINAL PRORROGACAO 2 COM DATA INICIAL PRORROGACAO 2 ********  //


// ********** INICIO VERIFICACAO DATA INICIAL PRORROGACAO 3 COM DATA FINAL PRORROGACAO 2 ********  // 
dataPro3.addEventListener("blur", function() {

        let dataProFc = document.getElementById("prorrog2_fim_pror");
        console.log(dataProFc);
        let dataPro3 = document.getElementById("prorrog3_ini_pror");

        dataProFV2b = dataProFc.value;
        dataPro3V = dataPro3.value;
        console.log(dataProFV2b);
        console.log(dataPro3V);

        dataProFV2bDao = new Date(dataProFV2b);
        dataPro3Dao = new Date(dataPro3V);

        var dataProVF2b = (dataProFV2bDao.getUTCDate());
        var dataProV3 = (dataPro3Dao.getUTCDate());

        console.log(dataProVF2b);
        console.log(dataProV3);

        var dif15 = dataProV3 < dataProVF2b; // ver se a data inicial da prorrogacao2 é menor que a data da prorrogacao1
        console.log(dif15);

        var divMsg5 = document.querySelector("#notif-input5");

        if (dif15 === true) {
            console.log(dif15);
            divMsg5.style.display = "block";
            dataPro2.style.borderColor = "red";
            dataPro2.value = "";
            dataPro2.focus();

        } else {
            divMsg5.style.display = "none";
            dataPro2.style.borderColor = "gray";

        }
    })
    // ********** FIM VERIFICACAO DATA INICIAL PRORROGACAO 3 COM DATA FINAL PRORROGACAO 2 ********  //