// ****************************************** //
// PEGAR DADOS DOS INPUTS //    
// ****************************************** //

let dataInt = document.getElementById("data_intern_int");

// ********** INICIO VERIFICAR DATA INTERNACAO ********  // 
dataInt.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE

        let dataInt = document.getElementById("data_intern_int");
        let dataVis = document.getElementById("data_visita_int");

        dataIntV = dataInt.value;
        dataVisV = dataVis.value;

        dataIntVDao = new Date(dataIntV);
        dataVisDao = new Date(dataVisV);

        var dataIntV = (dataIntVDao.getUTCDate());
        var dataVisV = (dataVisDao.getUTCDate());

        var dif1 = dataIntV > dataVisV; // ver se a data inicial da prorrogacao é menor que a data da internacao
        var divMsg = document.querySelector("#notif-input");

        if (dif1 === true) {
            divMsg.style.display = "block";
            dataInt.style.borderColor = "red";
            dataInt.value = "";
            dataInt.focus();

        } else {
            divMsg.style.display = "none";
            dataInt.style.borderColor = "gray";

        }

    })
    // ********* FIM VERIFICAR DATA INICIAL ********// 



// console.log(`${dataVisDao.getUTCFullYear()}-${(dataVisDao.getUTCMonth() + 1).toString().padStart(2, '0')}-${dataVisDao.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
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