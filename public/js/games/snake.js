function addCellNumbers() {
    let cells = $('.snakecell');

    cells.each((i, cell) => {
        // Si la valeur de i est comprise entre 0 et 9, ou si c'est un nombre dont le premier chiffre est pair
        if(String(i).length == 1 || (String(i).length == 2 && Number(String(i)[0])) % 2 == 0) {
            $(cell).html(100 - i - 1);
        }
        else {
            // Le numéro de cellule est un nombre dont le premier caractère est 9 moins le premier chiffre de i
            // et le deuxième caractère est le second chiffre de i
            // ex : i = 13, le numéro sera 83
            $(cell).html(Number(`${9 - Number(String(i)[0])}${String(i)[1]}`));
        }
    });
}

$(function() {
    addCellNumbers();
});