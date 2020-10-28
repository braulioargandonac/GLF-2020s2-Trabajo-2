<template>
    <div>
        <div>
            <h1 class="text-center textocolor fredoka mt-5 pt-4">Crear Autómata</h1>
            <div class="row justify-content-center">
                <div class="grafo1 col-md-5 card cardaux mr-3">
                    <div class="container-fluid mr-4">
                        <h3 class="mt-3">Seleccione el tipo de autómata:</h3>
                        <select class="custom-select mb-3 mr-3 mt-2" v-model="option">
                            <option selected :value="0">Seleccione un tipo de autómata</option>
                            <option :value="1">Autómata Finito Determinista (AFD)</option>
                            <option :value="2">Autómata Finito no Determinista (AFND)</option>
                        </select>
                    </div>
                    <div class="container-fluid py-4 mr-4" v-if="option===1">
                        <h3 class="mt-2">Autómata Finito Determinista (AFD)</h3>
                        <hr>
                        <div class="row text-center">

                        </div>
                    </div>
                    <div class="container-fluid py-4 mr-4" v-if="option===2">
                        <h3 class="mt-2">Autómata Finito no Determinista (AFND)</h3>
                        <hr>
                        <div class="row text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-center fredoka textocolor my-4">Operaciones</h1>
            <div class="row justify-content-center">
                <div class="card cardaux4 col-md-10 rounded-top">
                    <div class="btn-group justify-content-center" role="group">
                        <a href="#afd-equivalente"><button class="btn btn-secondary" @click="mostrarOp1">AFD equivalente</button></a>
                        <a href="#complemento"><button class="btn btn-secondary" @click="mostrarOp2">Complemento</button></a>
                        <a href="#union"><button class="btn btn-secondary" @click="mostrarOp3">Unión</button></a>
                        <a href="#concatenacion"><button class="btn btn-secondary" @click="mostrarOp4">Concatenación</button></a>
                        <a href="#interseccion"><button class="btn btn-secondary" @click="mostrarOp5">Intersección</button></a>
                    </div>
                </div>

                <!--Caso 1: AFD EQUIVALENTE -->
                <div class="cardaux2 col-md-10" v-if="operacion===1">
                    <h3 class="text-center fredoka textocolor my-3">AFD equivalente</h3>
                </div>
                <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===1">
                    <div class="container">
                        aaaaaaa
                    </div>
                </div>

                <!--Caso 2: COMPLEMENTO -->
                <div class="cardaux2 col-md-10" v-if="operacion===2">
                    <h3 class="text-center fredoka textocolor my-3">Complemento</h3>
                </div>
                <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===2">
                    <div class="container">
                        aaaaaaa
                    </div>
                </div>

                <!--Caso 3: UNION -->
                <div class="cardaux2 col-md-10" v-if="operacion===3">
                    <h3 class="text-center fredoka textocolor my-3">Unión</h3>
                </div>
                <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===3">
                    <div class="container">
                        aaaaaaa
                    </div>
                </div>

                <!--Caso 4: CONCATENACION -->
                <div class="cardaux2 col-md-10" v-if="operacion===4">
                    <h3 class="text-center fredoka textocolor my-3">Concatenación</h3>
                </div>
                <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===4">
                    <div class="container">
                        aaaaaaa
                    </div>
                </div>

                <!--Caso 5: INTERSECCION -->
                <div class="cardaux2 col-md-10" v-if="operacion===5">
                    <h3 class="text-center fredoka textocolor my-3">Intersección</h3>
                </div>
                <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===5">
                    <div class="container">
                        aaaaaaaa
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data(){
        return{
            option:'',
            operacion:'',

        }
    },
    
    created(){

    },

    methods:{
        mostrarOp1(){
            this.operacion=1;
            return;
        },
        
        mostrarOp2(){
            this.operacion=2;
            return;
        },

        mostrarOp3(){
            this.operacion=3;
            return;
        },

        mostrarOp4(){
            this.operacion=4;
            return;
        },

        mostrarOp5(){
            this.operacion=5;
            return;
        },

        ingresarAutomata(){

        },

        afdEquivalente(){

        },

        complemento(){

        },

        union(){

        },

        concatenacion(){

        },

        interseccion(){

        },

        simplificar(){

        },
        

    },

}
</script>