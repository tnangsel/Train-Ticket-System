<?php
include('header.php');
?>
<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        background-position: relative;
        color: white;
        text-shadow: 3px 3px 3px rgba(0, 0, 0, .25);
    }

    h1 {
        font-size: 4rem;
    }

    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(6, 10, 0, .15);
    }

    @media (max-width: 780){
        .welcome {
            min-height: 60vh;
        }
        h1 {
            font-size: 3rem;
        }

    } 
    .card {
        /* width: 30rem;
        height: 10rem; */
        background-color: transparent !important;
        border: 0px;
        border-radius: 15px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .wavy {
        display: inline-block;
        position: relative;
        color: yellow;
    }

    .wavy::before,
    .wavy::after {
        content: attr(data-text);
        position: absolute;
        left: 0;
        top: 0;
    }

    .wavy::before {
        animation: welcome 0.5s ease-in-out forwards;
        color: red;
    }

    .wavy::after {
        animation: welcome 0.5s ease-in-out 0.25s forwards;
        color: orange;
    }

    .wavy span:nth-child(1)::before,
    .wavy span:nth-child(6)::before {
        animation-delay: 0.1s;
    }

    .wavy span:nth-child(2)::before,
    .wavy span:nth-child(5)::before {
        animation-delay: 0.2s;
    }

    .wavy span:nth-child(3)::before,
    .wavy span:nth-child(4)::before {
        animation-delay: 0.3s;
    }

    @keyframes welcome {
        0% {
        transform: translateY(0);
        }
        25% {
        transform: translateY(-20px);
        }
        50% {
        transform: translateY(0);
        }
        75% {
        transform: translateY(20px);
        }
        100% {
        transform: translateY(0);
        }
    }

</style>
<main>
   
<?php if($_SESSION['type'] == 'admin'){ ?>
    <div class="welcome" style="background-image: url('img/trainstation.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
                <h1>
                    <span class="wavy" data-text="W"><span>W</span></span>
                    <span class="wavy" data-text="e"><span>e</span></span>
                    <span class="wavy" data-text="l"><span>l</span></span>
                    <span class="wavy" data-text="c"><span>c</span></span>
                    <span class="wavy" data-text="o"><span>o</span></span>
                    <span class="wavy" data-text="m"><span>m</span></span>
                    <span class="wavy" data-text="e"><span>e</span></span>
                    <span class="wavy" data-text=""><span></span></span>
                    <span class="wavy" data-text="A"><span>A</span></span>
                    <span class="wavy" data-text="d"><span>d</span></span>
                    <span class="wavy" data-text="m"><span>m</span></span>
                    <span class="wavy" data-text="i"><span>i</span></span>
                    <span class="wavy" data-text="n"><span>n</span></span>
                    <span class="wavy" data-text="!"><span>!</span></span>       
                </h1>
            </div>                                                    
    </div>
<?php }elseif($_SESSION['type'] == 'user'){ ?>
    <div class="welcome" style="background-image: url('img/railway.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
            <h1>
                <span class="wavy" data-text="W"><span>W</span></span>
                <span class="wavy" data-text="e"><span>e</span></span>
                <span class="wavy" data-text="l"><span>l</span></span>
                <span class="wavy" data-text="c"><span>c</span></span>
                <span class="wavy" data-text="o"><span>o</span></span>
                <span class="wavy" data-text="m"><span>m</span></span>
                <span class="wavy" data-text="e"><span>e</span></span>
                <span class="wavy" data-text=""><span></span></span>
                <span class="wavy" data-text="U"><span>U</span></span>
                <span class="wavy" data-text="s"><span>s</span></span>
                <span class="wavy" data-text="e"><span>e</span></span>
                <span class="wavy" data-text="r"><span>r</span></span>
                <span class="wavy" data-text="!"><span>!</span></span>       
            </h1>  
        </div>                                                    
    </div>
<?php }else{ ?>
    <div class="welcome" style="background-image: url('img/railway.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
            <div class="card">  
                <h1>
                    <span class="wavy" data-text="W"><span>W</span></span>
                    <span class="wavy" data-text="e"><span>e</span></span>
                    <span class="wavy" data-text="l"><span>l</span></span>
                    <span class="wavy" data-text="c"><span>c</span></span>
                    <span class="wavy" data-text="o"><span>o</span></span>
                    <span class="wavy" data-text="m"><span>m</span></span>
                    <span class="wavy" data-text="e"><span>e</span></span> 
                    <span class="wavy" data-text="!"><span>!</span></span>   
                </h1>
            </div>
        </div>                                                    
    </div>
<?php } ?>
</main>

<?php
include('footer.php');
?>