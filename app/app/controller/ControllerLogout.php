<?php
namespace App\controller;

session_start();

class ControllerLogout 
{
    public function __construct()
    {
    require_once DIRREQ."/app/view/layout/head.php";
    session_destroy();
    if( session_id() == null ){

        echo "
        <style>
        .divLogout{
            margin-top: 12%;
        }
        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #1abc9c;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes lds-ellipsis1 {
            0% {
            transform: scale(0);
            }
            100% {
            transform: scale(1);
            }
        }container
        @keyframes lds-ellipsis3 {
            0% {
            transform: scale(1);
            }
            100% {
            transform: scale(0);
            }
        }
        @keyframes lds-ellipsis2 {
            0% {
            transform: translate(0, 0);
            }
            100% {
            transform: translate(24px, 0);
            }
        }
        
        </style>
        
        
        ";
        echo "
            <div class='container divLogout text-center'>
            <img src=" . DIRIMG . 'logo.png' . "><br>	
                <div class='lds-ellipsis'><div></div><div></div><div></div>
            </div>
            
            <p>Sua sessão foi encerrada com sucesso.</p>
            <p>Aguade, você será redimensionado.</p>";
        header("Refresh:4; url=login");
    }

}
}