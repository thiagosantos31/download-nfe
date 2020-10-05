<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Automático de NFe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body style="height: 100vh; overflow: hidden;">

    <?php

        if(isset($_GET['arquivo']) != ""){
            $handle = fopen($_GET['arquivo'], "r");

            $row = 0;
            $travaPasta = 0;
            
            while ($line = fgetcsv($handle, 0, ";")) {
                if ($row++ == 0) {
                    continue;
                }
            
            $pontuacao = array(".", "-");
            $inscricao = str_replace($pontuacao, "", $line[8]);
            
            $link = "https://nfe.prefeitura.sp.gov.br/contribuinte/notaprintimg.aspx?inscricao=$inscricao&nf=$line[1]&verificacao=$line[3]&imprimir=1";
            $numNota = "$line[8]/NFS $line[1].gif";
            
            $temp = "C:\Users\Public\Documents\Notas Baixadas";

            if ($travaPasta < 1 ) {
                mkdir($line[8]);
                $travaPasta = 1;
            }

            copy($link, $numNota);

            }

            fclose($handle);

           
        }
    ?>

    <div class="container" style="height: 100vh!important;">

        <figure class="w-100 text-center mt-5" style="height: 30vh;">
            <img style="max-width: 120px;" src="tergec_logo.png" alt="">
            <h1 class="my-3 lead text-center">Sistema de Download de NFE</h1>
        </figure>


        <form action="" style="height: 50vh; display: flex; flex-direction: column;">

            <label class="w-100 text-center" for="filePath">

                <p class="lead">Selecione o arquivo CSV:</p>

                <input name="arquivo" class="my-5" type="file" id="arquivo" onchange="getFileName()" accept=".csv">
                
            </label>

            <br>

            <div class="w-100 text-center">
                <button type="submit" class="w-50 btn btn-primary"> Baixar! </button>
            </div>

        </form>

    </div>

    

    <!-- <script>

        function getFileName(){
            var name = document.getElementById('arquivo'); 
            var nomeArquivo = name.files.item(0).name;
        }

        getFileName();

    </script> -->
    
</body>
</html>
