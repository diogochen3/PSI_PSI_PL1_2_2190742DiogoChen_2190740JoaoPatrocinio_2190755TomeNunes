<?php use yii\helpers\Html;
use \yii\widgets\LinkPager;

/* @var $marcacoes array */?>
<!--<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">
<div>
    <div class="cardbox" style="float: left;">

        <div class="card marcacoes">
            <a href="table_marcacoes">
                <div class="card-front"><i class="far fa-bookmark"></i> </div>
                <div class="card-back">Marcações</div></a>
        </div>
    </div>

    <div class="cardbox" style="float: left;">
        <div class="card diagnosticos">
            <a href="..\diagnostico\index">
                <div class="card-front"><i class="fas fa-clipboard"></i> </div>
                <div class="card-back">Diagnosticos</div></a>
        </div>
    </div>

    <div class="cardbox" style="float: left;">
        <div class="card consultas">
            <a href="..\consultas\index">
                <div class="card-front"><i class="fas fa-calendar-check"></i> </div>
                <div class="card-back">Consultas</div></a>
        </div>
    </div>


    <div class="cardbox" style="float: left;">
        <div class="card especialidade">
            <a href="..\especialidade\index">
                <div class="card-front"><i class="fas fa-id-badge"></i> </div>
                <div class="card-back">Especialidade</div>
        </div>
    </div>
    <div>
        <div class="cardbox" style="float: left;">
            <div class="card utentes">
                <a href="table">
                    <div class="card-front"><i class="fas fa-user-friends"></i> </div>
                    <div class="card-back">Utentes</div></a>
            </div>
        </div>


        <div class="cardbox" style="float: left;">
            <div class="card medicamentos">
                <a href="..\medicamento\index">
                    <div class="card-front"><i class="fas fa-pills"></i> </div>
                    <div class="card-back">Medicamentos</div></a>
            </div>
        </div>

        <div class="cardbox" style="float: left;">
            <div class="card receitas">
                <a href="..\receitas\index">
                    <div class="card-front"><i class="fas fa-receipt"></i> </div>
                    <div class="card-back">Receitas</div></a>
            </div>
        </div>


    </div>



</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<style>

    .cardbox{
        perspective: 500px;
        margin: 15px;
    }

    .card{
        position: relative;
        border-radius: 5%;
        width: 120px;
        height: 120px;
        background: #fff;
        transform-style: preserve-3d;
        transition: 0.25s ease;
        box-shadow: 0 30px 30px rgba(0,0,0,0.5);
        cursor : pointer;
    }

    .marcacoes{
        background: #6997d0;

    }
    .diagnosticos{
        background: #87e97f;

    }
    .consultas{
        background: #a7e26c;

    }
    .especialidade{
        background: #cdd06a;

    }
    .utentes{
        background: #ab8440;

    }  .medicamentos{
           background: #d73ccf;

       }
    .receitas{
        background: #9d4e36;

    }





    .card-front , .card-back{
        position: absolute;
        top:0;
        left: 0;
        width: 120px;
        height: 120px;
        color: #fff;
        backface-visibility: hidden;

    }

    .card-front{
        font-size: 40px;
        justify-content: center;
        text-align: center;
        display: flex;
        align-items: center;
    }

    .card-back{
        font-size: 15px;
        justify-content: center;
        text-align: center;
        display: flex;
        align-items: center;
    }

    .cardbox:hover .card{
        transform: rotateY(180deg);
    }

    .card-back{
        transform: rotateY(180deg);
    }

</style>
