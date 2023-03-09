    // ****************************************** //
    // PEGAR DADOS DOS INPUTS //    
    // ****************************************** //

    let inputEnf = document.getElementById("valor_glosa_enf");
    let inputMed = document.getElementById("valor_glosa_med");
    let inputApresent = document.getElementById("valor_apresentado_capeante");
    let data_inicial_capeante = document.getElementById("data_inicial_capeante");
    let data_final_conta = document.getElementById("data_final_conta");
    let valorFinal = document.getElementById("valor_final_capeante");

    // ****************************************** //
    // METODO DE VERIFICAR DATAS DO CAPEANTE //
    // ****************************************** //

    // ENTRADA DE DADOS DE VALOR DATAS CAPEANTE - ESTRUTURA CONDICIONAL DATA INICIAL CAPEANTE
    data_inicial_capeante.addEventListener("blur", function() {

        // PEGAR DATA INICIAL DO CAPEANTE
        let dataInicConta = document.getElementById("data_inicial_capeante");
        datas = dataInicConta.value;

        let dataFech = document.getElementById("data_fech_capeante");
        dataAtuals = dataFech.value;

        data = new Date(datas);
        dataAtual = new Date(dataAtuals);

        console.log(`${data.getUTCFullYear()}-${(data.getUTCMonth()+1).toString().padStart(2, '0')}-${data.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01
        console.log(`${dataAtual.getUTCFullYear()}-${(dataAtual.getUTCMonth()+1).toString().padStart(2, '0')}-${dataAtual.getUTCDate().toString().padStart(2, '0')}`); // 1988-03-01

        var diaCap = (data.getUTCDate());
        console.log(data.getUTCFullYear());
        console.log(data.getUTCMonth() + 1);
        console.log(data.getUTCDate());
        var diaFech = (dataAtual.getUTCDate());

        console.log(diaCap - diaFech);

        console.log(dataAtual.getUTCDate());

    })