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
                            <div class="col-md-4">
                                <button class="btn btn-success" @click="createEstado">Añadir Estado</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-success" @click="createTransicion">Añadir Transición</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger" @click="delAndClear">Eliminar Estado</button>
                            </div>
                        </div>
                        <div class="my-4" v-if="validador">
                            <div>
                                <form @submit.prevent="agregarEstado">
                                    <div class="form-group">
                                        <label for="id">Ingrese el id: </label> 
                                        <input type="number" min="1" v-model="estado.id" name="id" class="form-control"> 
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                                    </div>
                                </form>       
                            </div>
                        </div>
                        <div v-if="createTrans" class="my-3">
                            <form @submit.prevent="crearTransicion">
                                <div class="form-group">
                                    <label>Ingrese el id del estado inicial de la transición:</label>
                                    <input type="number" min="1" v-model="transicion.from" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label>Ingrese el id del estado final de la transición:</label>
                                    <input type="number" min="1" v-model="transicion.to" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label>Ingrese carácter de la transición: </label>
                                    <input type="text" minlength="1" maxlength="1" pattern="[a-zA-Z]+" v-model="transicion.label" class="form-control">
                                </div>
                        
                                <button class="btn btn-success btn-sm" type="submit" >Agregar</button>
                                <button class="btn btn-success btn-sm" @click="drawAutomata">dibujar</button>
                            </form>
                        </div>
                    </div>
                    <div class="container-fluid py-4 mr-4" v-if="option===2">
                        <h3 class="mt-2">Autómata Finito no Determinista (AFND)</h3>
                        <hr>
                        <div class="row text-center">
                            
                        </div>
                    </div>
                </div>
                 <div class="grafo1 col-md-5 card cardaux ml-3">
                    <h3 class="text-center fredoka my-2">Representación</h3>
                    <div id="grafo" class="mb-3" style="border: 1px solid lightgray;"></div>
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
            estado: {id:'', label:'',color:'#C52C0B'},
            automata:{/*estados,alfabeto,transiciones,finales,inicio*/},
            estados:[{id:'inicio', label:'inicio',color:'#75616b47'}],
            alfabeto:[],
            transiciones:[],
            transicion:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            finales:{},
            validador:false,
            inicial:0,
            createTrans: false
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

        marcarInicial(){
            this.inicial=1;
            return;
        },
        
        agregarEstado(){
            var cont = this.contadorEstados
            this.estado.label=this.estado.id
            this.estados.push(this.estado)
            this.estado= {id:'', label:'',color:'#C52C0B'}
            this.drawAutomata()
            
        },

        createEstado(){
            this.validador=true;
            this.createTrans=false;
        },

        createTransicion(){
            this.createTrans=true;
            this.validador=false;
        },

        delAndClear(){  
            var ultimo= this.estados.pop();
            this.estados.pop()
            for(var i=0; i< this.transiciones.length;i++)
            {
                if(this.transiciones[i].from===ultimo.id || this.transiciones[i].to===ultimo.id)
                {
                    this.transiciones.splice(i,1);
                }
            }     
            
            
            console.log("Estado Eliminado");
            this.drawAutomata();
        },
 
        crearTransicion(){
            if(this.transicion.from==='' || this.transicion.to==='' )
            {
                alert("Estados o caracter no ingresados . Rellene todos los campos antes de continuar");
                return;
            }
            
            for(var i=0; i<this.transiciones.length;i++)
            {
                if(this.transiciones[i].from===this.transicion.from && this.transiciones[i].label===this.transicion.label)
                {
                    alert("la transición ya existe. Ingrese otra");
                    return;
                }
                
            }
            this.addCaracterToAlfabeto();
            this.transiciones.push(this.transicion);
            this.transicion={from:'',label: '',to:''};
            this.drawAutomata();
            
            
        },

        addCaracterToAlfabeto(){

            var existe=false;

            for (var i=0; i<this.transiciones.length;i++)
            {
                if(existe===true && this.transicion.label!= this.transiciones[i].label)
                {
                    existe==true
                }
                else{
                    if(this.transiciones[i].label===this.transicion.label)
                    {
                        existe=true;
                    }
                    else{
                        existe=false;
                    }
                }
            }
            
            if(!existe)
            {
                this.alfabeto.push(this.transicion.label);
            }

            console.log(this.alfabeto);
           /* var arregloAlfa = []
            for (var i=0; i<this.transiciones.length;i++){
                arregloAlfa.push(this.transiciones[i].label)
               
            }
            console.log(arregloAlfa);
            */
        },
        
        // revisarAlfabeto(){
        //   var nuevoAlfabeto 
        //   for (var i=0; i< Alfabeto ;i++){

        //   }  
        // },

        matrizAutomata(){
            var matrix = matrix.newArray()
        },

        crearMatriz(){
            var res = [];
            for(var i=0; i<3;i++){
                res[i]= new Array(this.estados.length*this.transiciones.length);
            }
            return res;
        },

    
    /*  var existe=false;

        for (var i=0; i<this.transiciones.length;i++)
        {
            if(existe===true && this.transicion.label!= this.transiciones[i].label)
            {
                existe==true
            }
            else{
                if(this.transiciones[i].label===this.transicion.label)
                {
                    existe=true;
                }
                else{
                    existe=false;
                }
            }
        }
        
        if(!existe)
        {
            this.alfabeto.push(this.transicion.label);
        }

        console.log(this.alfabeto);
    */


        drawAutomata(){
            var container= document.getElementById("grafo");
            var data={nodes:this.estados,
                      edges:this.transiciones};
            var options = {
                height: 520 + 'px',
                edges:{
                    
                    arrows:'to',
                },
            };
            var network= new vis.Network(container,data,options);
        },

        matrizAutomata(){
            var matrix = {}
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