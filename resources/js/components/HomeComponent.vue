<template>
    <div class="container mt-5 pt-4">
        <h1 class="fredoka textocolor my-2">Tipos de autómatas con los que se trabajará en esta aplicación web:</h1>
        <div class="row bg-white rounded shadow mt-4 cardaux">
            <div class="col-12 cardaux">
                <div class="row d-flex justify-content-center mx-2 my-2 pt-2">
                    <h4 class="textocolor fredoka my-2">Tipos de Autómatas</h4>
                </div>
                <hr>
                <div class="row accordion" id="automatas">
                    <ul class="col-lg-3 col-sm-12 my-2 list-group list-group-flush">
                        <li class="list-group-item analisis collapsed info textocolor" data-toggle="collapse" data-target="#af" aria-expanded="false" aria-controls="af">
                            Autómata Finito (AF)
                        </li>
                        <li class="list-group-item analisis collapsed info textocolor" data-toggle="collapse" data-target="#afd" aria-expanded="false" aria-controls="afd">
                            Autómata Finito Determinista (AFD)
                        </li>
                        <li class="list-group-item analisis collapsed info textocolor" data-toggle="collapse" data-target="#afnd" aria-expanded="false" aria-controls="afnd">
                            Autómata Finito no Determinista (AFND)
                        </li>
                    </ul>
                    <div class="col-lg-7 col-sm--12 my-2">
                        <div class="collapse" id="af" data-parent="#automatas">
                            <div class>
                                <div class="row d-flex justify-content-center">
                                    <h4 class="textocolor fredoka">Autómata Finito</h4>
                                </div>
                                <p class="textocolor lato" >
                                    Un autómata finito (AF) es un modelo computacional
                                    que realiza cómputos en forma automática sobre una entrada para producir una salida.
                                    Este modelo está conformado por un alfabeto, un conjunto de estados finito, una función de transición,
                                    un estado inicial y un conjunto de estados finales. 
                                    Su funcionamiento se basa en una función de transición, que recibe a partir de un estado inicial
                                    una cadena de caracteres pertenecientes al alfabeto (la entrada), 
                                    y que va leyendo dicha cadena a medida que el autómata se desplaza de un estado a otro, para finalmente
                                    detenerse en un estado final, que representa la salida.
                                </p>
                                <div class="row justify-content-center">
                                    <div class="image-parent">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/DFAexample.svg/500px-DFAexample.svg.png" class="img-fluid" alt="AF">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="collapse" id="afd" data-parent="#automatas">
                            <div class>
                                <div class="row d-flex justify-content-center">
                                    <h4 class="textocolor fredoka">Autómata Finito Determinista</h4>
                                </div>
                                <p class="textocolor lato" >
                                    Un autómata finito determinista (AFD) es un autómata finito que además es un sistema determinista;
                                    es decir, para cada estado q ∈ Q en que se encuentre el autómata, y con cualquier caracter a ∈ Σ del alfabeto leído,
                                    existe siempre a lo más una transición posible δ(q,a).
                                </p>
                                <div class="row justify-content-center">
                                    <div class="image-parent">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/NFA-powerset-construction-example.svg/360px-NFA-powerset-construction-example.svg.png" class="img-fluid" alt="AFD">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="afnd" data-parent="#automatas">
                            <div class>
                                <div class="row d-flex justify-content-center">
                                    <h4 class="textocolor fredoka">Autómata Finito no Determinista</h4>
                                </div>
                                <p class="textocolor lato"> 
                                    Un autómata finito no determinista (AFND) es aquel que, a diferencia de los autómatas finitos deterministas,
                                    posee al menos un estado q ∈ Q, tal que para un símbolo a ∈ Σ del alfabeto, existe más de una transición δ(q,a) posible.
                                </p>
                                <div class="row justify-content-center">
                                    <div class="image-parentmg">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/NFAexample.svg/600px-NFAexample.svg.png" class="img-fluid" alt="AFND">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>               
            </div>
        </div>          
        
    </div>
    
</template>