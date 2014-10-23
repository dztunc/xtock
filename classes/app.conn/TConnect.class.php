<?php 
#gerencia a conecção com o banco de dados através de um arquivo ".ini"

class XConectar
{
	private function __construct()
	{
		# code...
	}
	public static function open($nome)
	{
		#verifica se existe o arquivo ini
		if (file_exists("app.config/{$nome}.ini")) {
			#se existir irá ler
			$db = parse_ini_file("app.config/{$nome}.ini");
		}
		else
		{
			#se não existir mostra um erro
			throw new Exception("Erro ao processar o arquivo ");
		}
	#transforma em variavel cada resultado lido no arquivo ini
	$usuario = $db['usuario'];
	$senha = $db['senha'];
	$dbnome = $db['nome'];
	$host = $db['host'];
	$tipo = $db['sgbdtipo'];

	switch ($tipo) {
		case 'pgsql':
			$conn = new PDO("pgsql:dbname={$dbnome};user={$usuario};password={$senha};host={$host}");
			break;
		case 'mysql':
			$conn = new PDO("mysql:host={$host};port=3307;dbname={$dbnome}", $usuario, $senha);
			break;
		case 'sqlite':
			$conn = new PDO("sqlite:dbname={$dbnome}");
			break;		
					}	
	#PDO lançará exceções se acontecer algum erro
	$conn->setAttibute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	#retorna o objeto instanciado
	return $conn;
		
	}
}

 ?>