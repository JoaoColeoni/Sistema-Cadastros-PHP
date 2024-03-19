function somenteNumeros(event)
{
    var key = event.which || event.KeyCode;
    if(key >= 48 && key <= 57)
    {
        return true;
    }

    event.preventDefault(); 
    return false;
}

function maskCep(field)
{
    let inputlength = field.value.length;

    if(inputlength == 5)
    {
        field.value += '-';
    }
}

function maskCPF(field)
{
    let inputlength = field.value.length;

    if(inputlength == 3 || inputlength == 7)
    {
        field.value += '.';
    }
    else if(inputlength == 11)
    {
        field.value += '-';
    }
}

function maskRG(field)
{
    let inputlength = field.value.length;

    if(inputlength == 2 || inputlength == 6)
    {
        field.value += '.';
    }
    else if(inputlength == 10)
    {
        field.value += '-';
    }
}

function maskTelefone(field)
{
    let inputlength = field.value.length;

    if(inputlength == 0)
    {
        field.value += '(';
    }
    else if(inputlength == 3)
    {
        field.value += ') ';
    }
    else if(inputlength == 9)
    {
        field.value += '-';
    }

    if(inputlength == 14)
    {
        field.value = field.value.replace("-","");
        field.value = field.value.substring(0, 10) + "-" + field.value.substring(10,14);
    }
}