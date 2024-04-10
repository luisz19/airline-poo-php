<?php

class Voo {
  public $num_voo;
  public $origem;
  public $destino;
  public $data_hora_partida;
  public $data_hora_chegada;
  public $assentos_disponiveis;
  public $preco;
  public $comp_aerea_assoc;

   public function __construct($num_voo, $origem, $destino, $data_hora_partida, $data_hora_chegada, $assentos_disponiveis, $comp_aerea_assoc, $preco){
      $this->num_voo = $num_voo;
      $this->origem = $origem;
      $this->destino = $destino;
      $this->data_hora_partida = $data_hora_partida;
      $this->data_hora_chegada = $data_hora_chegada;
      $this->assentos_disponiveis = $assentos_disponiveis;
      $this->comp_aerea_assoc = $comp_aerea_assoc;
      $this->preco = $preco;
   }
} 

$voos = array();

$voo1 = new Voo(12, "Petrolina", "Juazeiro", "2024/04/23 20:00", "2024/04/23 12:00", 100, "Azul", 450);
$voos[] = $voo1;

$voo2 = new Voo(15, "Petrolina", "Araripina", "24/04/2024 10:00", "24/04/2024 12:00", 98, "Verde", 500);
$voos[] = $voo2;

echo "Voôs disponíveis: \n\n";
foreach ($voos as $voo) {
    echo "Número do Voo: " . $voo->num_voo . "\n";
    echo "Origem: " . $voo->origem . "\n";
    echo "Destino: " . $voo->destino . "\n";
    echo "Data e Hora de Partida: " . $voo->data_hora_partida . "\n";
    echo "Data e Hora de Chegada: " . $voo->data_hora_chegada . "\n";
    echo "Assentos Disponíveis: " . $voo->assentos_disponiveis . "\n";
    echo "Preço: R$" . $voo->preco . "\n\n";
}

echo "---------------------------\n\n";

/////////////////////////////////////////////////

class Passageiro{
  protected $nome;
  protected $cpf;
  protected $email;
  protected $tel;
  protected $num_passaporte;

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getCPF() {
    return $this->cpf;
  }

  public function setCPF($cpf) {
    $this->cpf = $cpf;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getDataNasc() {
    return $this->data_nasc;
  }


  public function getTel() {
    return $this->tel;
  }

  public function setTel($tel) {
    $this->tel = $tel;
  }

  public function setNumPassaporte ($num_passaporte) {
    $this->num_passaporte = $num_passaporte;
  }

  public function getNumPassaporte () {
    return $this->num_passaporte;
  }

}

///////////////////////////////////////////////////////////

abstract class Pagamento {
    protected $numeroCartao;
    protected $valor;
    protected $formaPagamento;


    public function realizarPagamento() {
        return "$this->formaPagamento. R$$this->valor. ";
    }

    public function getFormaPagamento() {
        return $this->formaPagamento;
    }
}

class PagamentoCredito extends Pagamento {
    protected $parcelas;

    public function __construct($formaPagamento, $numeroCartao, $valor, $parcelas) {
        $this->formaPagamento = $formaPagamento;
        $this->numeroCartao = $numeroCartao;
        $this->valor = $valor;
        $this->parcelas = $parcelas;
    }

    public function realizarPagamento() {
        return "$this->formaPagamento. R$$this->valor em $this->parcelas"."x";
    }

}

class PagamentoDebito extends Pagamento {
    public function __construct($formaPagamento, $numeroCartao, $valor) {
       $this->formaPagamento = $formaPagamento;
       $this->numeroCartao = $numeroCartao;
       $this->valor = $valor;
    }
}

//////////////////////////////////////////////////////////////////

class Reserva{
  protected $num_reserva;
  protected $num_voo;
  protected $origem;
  protected $destino;
  protected $voo_associado;
  protected $assento_reserva;
  protected $passageiro;
  protected $pagamento;

  public function __construct($num_reserva, Voo $num_voo, Voo $origem, Voo $destino, Voo $voo_associado, $assento_reserva, Passageiro $passageiro, Pagamento $pagamento) {
      $this->num_reserva = $num_reserva;
      $this->num_voo = $num_voo;
      $this->origem = $origem;
      $this->destino = $destino;
      $this->voo_associado = $voo_associado;
      $this->assento_reserva = $assento_reserva;
      $this->passageiro = $passageiro;
      $this->pagamento = $pagamento;
  }

  public function getPassageiro() {
      return $this->passageiro;
  }

  public function getVooAssociado() {
      return $this->voo_associado;
  }

  public function getOrigem() {
      return $this->origem;
  }

  public function getDestino() {
      return $this->destino;
  }

  public function getNumVoo() {
      return $this->num_voo;
  }

  public function getAssentoReserva() {
      return $this->assento_reserva;
  }

  public function getNumReserva() {
    return $this->num_reserva;
  }

  public function getPagamento() {
    return $this->pagamento;
  }

}

//instancia passageiro
$passageiro1 = new Passageiro();
$passageiro1->setNome("Han Solo");
$passageiro1->setCPF("151.222.567.13");
$passageiro1->setEmail("passageiro1@gmail.com");
$passageiro1->setTel("4002-8922");
$passageiro1->setNumPassaporte("6849");

$passageiro2 = new Passageiro();
$passageiro2->setNome("Anakin");
$passageiro2->setCPF("321.435.564.18");
$passageiro2->setEmail("passageiro2@gmail.com");
$passageiro2->setTel("1902-5673");
$passageiro2->setNumPassaporte("4032");

$dados = array(); //armazenar dados do passageiro
$dados[] = $passageiro1;
$dados[] = $passageiro2;


//instancia pagamento
$pagamento1 = new PagamentoDebito("Débito", "1234 5678", "450");
$pagamento2 = new PagamentoCredito("Crédito", "5678 1234", "500", "2");


//info reserva
$reservas = array(); //array para armazenar as reservas

$reserva1 = new Reserva("134", $voo1, $voo1, $voo1, $voo1, "5", $passageiro1, $pagamento1);
$reservas[] = $reserva1;

$reserva2 = new Reserva("136", $voo2, $voo2, $voo2, $voo2, "10", $passageiro2, $pagamento2);
$reservas[] = $reserva2;

foreach ($reservas as $reservas) {
  echo "Passagem do cliente \n";
  echo "Nome do passageiro: " . $reservas->getPassageiro()->getNome() . "\n";
  echo "Número da reserva: " . $reservas->getNumReserva() . "\n";
  echo "Número do voo: " . $reservas->getNumVoo()->num_voo . "\n";
  echo "Origem: " . $reservas->getOrigem()->origem . "\n";
  echo "Destino: " . $reservas->getDestino()->destino . "\n";
  echo "Companhia Aérea: " . $reservas->getVooAssociado()->comp_aerea_assoc . "\n";
  echo "Assento reservado: " . $reservas->getAssentoReserva() . "\n";
  echo "Forma de pagamento: " . $reservas->getPagamento()->realizarPagamento() . "\n\n";
}

echo "-------------------------\n\n";

//////////////////////////////////////////////////

echo "Dados dos passageiros: \n\n";

foreach ($dados as $dado) {
  echo "Nome: " . $dado->getNome() . "\n";
  echo "CPF: " . $dado->getCPF() . "\n";
  echo "Email: " . $dado->getEmail() . "\n";
  echo "Telefone: " . $dado->getTel() . "\n";
  echo "Número do passaporte: " . $dado->getNumPassaporte() . "\n\n";
}











