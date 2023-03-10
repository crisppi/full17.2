
// ****************************************** //
// ENTRADA DE DADOS DE VALOR GLOSA MEDICA - ESTRUTURA CONDICIONAL
// ****************************************** //
inputMed.addEventListener("blur", function () {

    // LIMPAR DADOS DO INPUT - valor_glosa_enf
    finalEnf = inputEnf.value;
    var finalEnf2 = finalEnf;
    finalEnf2 = finalEnf.replace(".", "");
    finalEnf2 = finalEnf.replace(",", ".");
    finalEnf2 = parseFloat(finalEnf2);

    // LIMPAR DADOS DO INPUT - valor_glosa_med
    finalMed = inputMed.value;
    var finalMed2 = finalMed;
    finalMed2 = finalMed.replace(".", "");
    finalMed2 = finalMed.replace(",", ".");
    finalMed2 = parseFloat(finalMed2);

    // INSERIR VALOR NO INPUT DE DADOS
    finalGlosa = finalEnf2 + finalMed2;
    let inputGlosa = document.getElementById("valor_glosa_total");
    inputGlosa.value = finalGlosa;

    finalGlosa = inputGlosa.value;
    var finalGlosa2 = finalGlosa;

    // PREENCHIMENTO DE CAMPO GLOSA TOTAL
    finalGlosa2 = finalGlosa.replace(".", "");
    finalGlosa2 = finalGlosa.replace(",", ".");
    finalGlosa2 = parseFloat(finalGlosa2);

    var valorFormatGlosa = finalGlosa2.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    inputGlosa.value = valorFormatGlosa;
    inputGlosa.style.fontWeight = 600;
    inputGlosa.style.borderColor = "green";
    inputGlosa.style.backgroundColor = "#808080";
    inputGlosa.style.color = "white";

    // LIMPAR DADOS DO INPUT - valor_apresentado_capeante
    apresCapeante = inputApresent.value;
    var apresCapeante2 = apresCapeante;
    apresCapeante2 = apresCapeante2.replace(".", "");
    apresCapeante2 = apresCapeante2.replace(",", ".");
    apresCapeante2 = parseFloat(apresCapeante2);

    // PREENCHIMENTO DO CAMPO FINAL CAPEANTE
    finalCapeante = apresCapeante2 - (finalEnf2 + finalMed2);

    var finalCapeante2 = finalCapeante;
    valorFinal.value = finalCapeante;
    finalCapeante = valorFinal.value;

    var valorFormatFinal = finalCapeante2.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });
    valorFinal.value = valorFormatFinal;
    valorFinal.style.fontWeight = 600;
    valorFinal.style.borderColor = "green";
    valorFinal.style.backgroundColor = "#808080";
    valorFinal.style.color = "white";

});

$(document).ready(function () {
    $("input.dinheiro").maskMoney({
        showSymbol: true,
        symbol: "R$",
        decimal: ",",
        thousands: "."
    });
});




function cancelar() {
    let idAcoes = (document.getElementById('id-confirmacao'));
    idAcoes.style.display = 'none';
    console.log("chegou no cancelar");

};
