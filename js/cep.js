const $txtCep = document.getElementById('cep');
const $txtLogradouro = document.getElementById('logradouro');
const $txtBairro = document.getElementById('bairro');
const $txtCidade = document.getElementById('cidade');
const $txtEstado = document.getElementById('estado');

const encontrarCep = () => {
    const cep = $txtCep.value;
    const url = `http://viacep.com.br/ws/${cep}/json/`;
    //o fetch busca a resposta da url 

    fetch ( url )
        .then (res => res.json() )
        .then (res => mostrarCep(res) );

    const mostrarCep = (endereco) => {
        $txtLogradouro.value = endereco.logradouro;
        $txtBairro.value = endereco.bairro;
        $txtCidade.value = endereco.localidade;
        $txtEstado.value = endereco.uf;
        
        $txtLogradouro.setAttribute("readonly", "true");
        $txtBairro.setAttribute("readonly", "true");
        $txtCidade.setAttribute("readonly", "true");
        $txtEstado.setAttribute("readonly", "true");

        $txtLogradouro.style.backgroundColor = "#ccc";
        $txtBairro.style.backgroundColor = "#ccc";
        $txtCidade.style.backgroundColor = "#ccc";
        $txtEstado.style.backgroundColor = "#ccc";
    }
}
$txtCep.addEventListener( "blur", encontrarCep )