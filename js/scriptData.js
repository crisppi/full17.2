// ****************************************** //
// PEGAR DADOS DOS INPUTS //    
// ****************************************** //

let inputEnf = document.getElementById("valor_glosa_enf");
let inputMed = document.getElementById("valor_glosa_med");
let inputApresent = document.getElementById("valor_apresentado_capeante");
let data_inicial_capeante = document.getElementById("data_inicial_capeante");
let data_final_conta = document.getElementById("data_final_conta");
let valorFinal = document.getElementById("valor_final_capeante");
let dataInt = document.getElementById("data_intern_int");

// ****************************************** //
// METODO DE VERIFICAR DATAS DO CAPEANTE //
// ****************************************** //

// ENTRADA DE DADOS DE VALOR DATAS CAPEANTE - ESTRUTURA CONDICIONAL DATA INICIAL CAPEANTE
data_inicial_capeante.addEventListener("blur", function () {

    // PEGAR DATA INICIAL DO CAPEANTE
    let dataInicConta = document.getElementById("data_inicial_capeante");
    dataInicContaV = dataInicConta.value;

    let dataFinalConta = document.getElementById("data_final_conta");
    dataFinalContaV = dataFinalConta.value;

    let dataInt = document.getElementById("data_intern_int");
    dataIntV = dataInt.value;

    dataInicContaDao = new Date(dataInicContaV);
    dataFinalContaDao = new Date(dataFinalContaV);
    dataIntVDao = new Date(dataIntV);

    // console.log(`${dataInicContaDao.getUTCFullYear()}-${(dataInicContaDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataInicContaDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
    // console.log(`${dataFechVDao.getUTCFullYear()}-${(dataFechVDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataFechVDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
    // console.log(`${dataIntVDao.getUTCFullYear()}-${(dataIntVDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataIntVDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01

    var diaIni = (dataInicContaDao.getUTCDate());
    var diaFin = (dataFinalContaDao.getUTCDate());
    var diaInt = (dataIntVDao.getUTCDate());

    console.log("dia ini" + diaIni);
    console.log("dia fin" + diaFin);
    console.log("dia inter" + diaInt);

    var dif1 = diaIni < diaInt; // ver se a data inicial da prorrogacao é menor que a data da internacao
    var dif2 = diaIni < diaFin; // ver se a data inicial da prorrogacao é menor que a data final da prorrogacao
    console.log(dif1);
    console.log(dif2);

    // console.log(data.getUTCFullYear());
    // console.log(data.getUTCMonth() + 1);
    // console.log(data.getUTCDate());
    // var diaFech = (dataAtual.getUTCDate());

    // console.log(diaCap - diaFech);

    // console.log(dataAtual.getUTCDate());

})