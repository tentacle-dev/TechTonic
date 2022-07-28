
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box
    }
    body{
        background-image: url("blouse-2597205_1920.jpg");
    
           
    }
    
    .form-input {
        position: relative;
        margin-bottom: 10px;
        margin-top: 10px
    }
    
    .form-input i {
        position: absolute;
        font-size: 18px;
        top: 15px;
        left: 10px
    }
    
    .form-control {
        height: 50px;
        background-color: #1c1e21;
        color:#fff;
        text-indent: 24px;
        font-size: 15px
    }
    
    .form-control:focus {
        box-shadow: none;
        border-color: #4f63e7;
    }
    
    .form-check-label {
        margin-top: 2px;
        font-size: 14px
    }
    
    #heading{
        background: #833ab4;
        background: rgb(8,205,233);
        background: linear-gradient(274deg, rgba(8,205,233,1) 0%, rgba(0,48,255,1) 0%, rgba(2,207,255,1) 48%, rgba(4,43,255,1) 100%);
        color: #fff;
        background-size: 100% ;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-text-fill-color: transparent;
    }
    #white{
        color: blanchedalmond;
        background: #833ab4;
        background: rgb(8,205,233);
    background: linear-gradient(274deg, rgba(8,205,233,1) 0%, rgba(222,224,233,1) 0%, rgba(2,207,255,1) 48%, rgba(231,234,250,1) 100%);
       
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-text-fill-color: transparent;
        font-weight: bold;
        -webkit-text-stroke: 0.01px white;
        transform: scale(1);
    }
    #welcome{
        font-family:  sans-serif;
    
        transform: skew(-20deg, 20deg);
        background: #833ab4;
        background: rgb(8,205,233);
    background: linear-gradient(274deg, rgba(8,205,233,1) 0%, rgba(222,224,233,1) 0%, rgba(2,207,255,1) 48%, rgba(231,234,250,1) 100%);
        color: #fff;
        background-size: 100% ;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-text-fill-color: transparent;
    }
    .row{
        background: grey;
        border-radius: 30px;
        box-shadow: 12px 12px 22px grey;
    }
    .form-control{
        margin-top: 20px;
        margin-bottom: 20px;
        z-index: 2;
        
    
    
    }
    
    
    .container{
        margin-top: 100px;
        z-index:858;
        opacity: 0.8;
    
    
    }
    .errormsgs{
        font-weight:7600;
        font-size:18px;
        -webkit-text-fill-color: red;
        z-index:999;
     
    
    }
    .btn1{
        border: none;
        outline: null;
        height: 50px;
        width: 100%;
        background: #000;
        color: white;
        font-weight: bold;
        font-size: 1.8rem;
        background: #833ab4;
        background: rgb(8,205,233);
    background: linear-gradient(274deg, rgba(8,205,233,1) 0%, rgba(222,224,233,1) 0%, rgba(2,207,255,1) 48%, rgba(231,234,250,1) 100%);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        transition: all 0.35s;
        outline: none;
    }
    .btn1:hover{
        background: #fff;
        border: 1px solid black;
        color: #000;
        transform: scale(1.2);
    }
    
    
    
    @media screen and (max-width: 768px) {
        .img-fluid{
            display: none;
        }
        #logo{
            text-align: center;
        }
        #welcome{
            display: none;
    
        }
        
    }
