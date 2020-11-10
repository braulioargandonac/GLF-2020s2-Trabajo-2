<template>
    <div>
        <!-- crear automata 1 crear automata 2 
        crear 1 // afd afnd 
        crear 2 // afd afnd 
        automataCreate -->
        <h1 class="text-center textocolor fredoka mt-5 pt-4">Crear Autómata</h1> 
        
        <div class="row justify-content-center">
            <div class="grafo1 col-md-5 mx-3 card cardaux" v-if="representacion1===false">
                <div class="container-fluid mr-4">
                    <div class="row justify-content-center" v-if="!automataCreate">
                        <div class="row my-3">
                            <div class="col-md-6"><button class="btn btn-success info textocolor" @click="selectAutomata1">Crear autómata 1</button></div>
                            <div class="col-md-6"><button class="btn btn-success info textocolor" @click="selectAutomata2">Crear autómata 2</button></div>
                        </div>
                    </div>   
                    <div v-if="automataCreate===true" class="my-3">
                        <h3 class="mt-3" v-if="selectAuto===1">Autómata 1</h3>
                        <h3 class="mt-3" v-if="selectAuto===2">Autómata 2</h3>
                        <h4 class="mt-3">Seleccione el tipo de autómata:</h4>
                        <select class="custom-select mb-3 mr-3 mt-2" v-model="option" >
                            <option selected :value="0">Seleccione un tipo de autómata</option>
                            <option :value="1">Autómata Finito Determinista (AFD)</option>
                            <option :value="2">Autómata Finito no Determinista (AFND)</option>
                        </select>
                        <button class="btn btn-success" @click="back">Volver</button>   
                    </div>         
                </div>
                <div class="container-fluid py-4 mr-4" v-if="option===1">
                    <h3 class="mt-2">Autómata Finito Determinista (AFD)</h3>
                    <hr>
                    <div class="row text-center my-4">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-success" @click="createEstado">Añadir Estado</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success" @click="createTransicion">Añadir Transición</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-success" @click="representacion">Modificar Estado Final</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-danger" @click="delAndClear">Eliminar Estado</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="my-4" v-if="validador">
                        <div>
                            <form @submit.prevent="agregarEstado" v-if="selectAuto===1">
                                <div class="form-group">
                                    <label for="id">Ingrese el id: </label> 
                                    <input type="number" min="1" v-model="estadoAutomata1.id" name="id" class="form-control"> 
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                                </div>
                            </form>       

                            <form @submit.prevent="agregarEstado" v-else>
                                <div class="form-group">
                                    <label for="id">Ingrese el id: </label> 
                                    <input type="number" min="1" v-model="estadoAutomata2.id" name="id" class="form-control"> 
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div v-if="createTrans" class="my-3">
                        <form @submit.prevent="crearTransicion" v-if="selectAuto===1">
                            <div class="form-group">
                                <label>Ingrese el id del estado inicial de la transición:</label>
                                <input type="number" min="1" v-model="transicionAutomata1.from" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label>Ingrese el id del estado final de la transición:</label>
                                <input type="number" min="1" v-model="transicionAutomata1.to" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label>Ingrese carácter de la transición: </label>
                                <input type="text" minlength="1" maxlength="1" pattern="[a-zA-Z]+" v-model="transicionAutomata1.label" class="form-control">
                            </div>
                    
                            <button class="btn btn-success btn-sm" type="submit" >Agregar</button>
                        </form>

                        <form @submit.prevent="crearTransicion" v-else>
                            <div class="form-group">
                                <label>Ingrese el id del estado inicial de la transición:</label>
                                <input type="number" min="1" v-model="transicionAutomata2.from" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label>Ingrese el id del estado final de la transición:</label>
                                <input type="number" min="1" v-model="transicionAutomata2.to" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label>Ingrese carácter de la transición: </label>
                                <input type="text" minlength="1" maxlength="1" pattern="[a-zA-Z]+" v-model="transicionAutomata2.label" class="form-control">
                            </div>
                    
                            <button class="btn btn-success btn-sm" type="submit" >Agregar</button>
                        </form>
                    </div>
                </div>
                <div class="container-fluid py-4 mr-4" v-if="option===2">
                    <h3 class="mt-2">Autómata Finito no Determinista (AFND)</h3>
                    <hr>
                     <div class="row text-center my-4">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-success" @click="createEstado">Añadir Estado</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success" @click="createTransicion">Añadir Transición</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-success" @click="representacion">Modificar Estado Final</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-danger" @click="delAndClear">Eliminar Estado</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="my-4" v-if="validador">
                        <div>
                            <form @submit.prevent="agregarEstado" v-if="selectAuto===1">
                                <div class="form-group">
                                    <label for="id">Ingrese el id: </label> 
                                    <input type="number" min="1" v-model="estadoAutomata1.id" name="id" class="form-control"> 
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                                </div>
                            </form>       

                            <form @submit.prevent="agregarEstado" v-if="selectAuto===2">
                                <div class="form-group">
                                    <label for="id">Ingrese el id: </label> 
                                    <input type="number" min="1" v-model="estadoAutomata2.id" name="id" class="form-control"> 
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grafo1 col-md-5 mx-3 card cardaux">
                <h3 class="text-center fredoka my-2">Representación</h3>
                <div id="grafo" class="mb-3" style="border: 1px solid lightgray;"></div>
                <div id="grafo2" class="mb-3" style="border: 1px solid lightgray;"></div>
                
            </div>
            <div class="grafo1 col-md-5 mx-3 card cardaux" v-if="representacion1===true">
                <hr>
                <div>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Estado</th> 
                            <th scope="col">Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in estadosAutomata1" :key="index">
                                <td scope="row">{{index}}</td>
                                <td>{{item.label}}</td>
                                <td>
                                    <div>
                                        
                                        
                                        <input type="checkbox" name="state" id="state" @click="marcarFinal(item.id)" :checked="estadosAutomata1[index].final">
                                        <label for="state">Estado Final</label>
                                    </div>
                                </td>

                            
                            </tr>

                            
                        </tbody>    
                    </table> 
                    <button class="btn btn-success mb-3 btn-sm text-right" type="submit" @click="representacionBack">Guardar</button>
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
</template>

<script>
export default {

    data(){
        return{
            automata:{/*estados,alfabeto,transiciones,finales,inicio*/},

            estadosAutomata1:[{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            estadoAutomata1: {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'},
            transicionesAutomata1:[],
            transicionAutomata1:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            alfabeto1:[],

            estadosAutomata2:[{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            estadoAutomata2: {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'},
            transicionAutomata2:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesAutomata2:[],
            alfabeto2:[],

            option:0,
            operacion:'', 
            validador:false,
            inicial:0,
            createTrans: false,
            representacion1:false,
            checked:false,
            automataCreate:false,
            selectAuto:''
        }
    },
    

    created(){
        
    },

    methods:{
        
        selectAutomata1(){
            this.selectAuto=1
            this.automataCreate=true
            return
        },

        back(){
            this.automataCreate=false;
            this.option=0;
            this.createTrans=false;
            this.validador=false;
            return
        },
        
        selectAutomata2(){
            this.selectAuto=2;
            this.automataCreate=true;
            return
        },
        
        representacion(){
            this.representacion1=true;
            return;
        },
        representacionBack(){
            this.representacion1=false;
            return;
        },
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
        mostrartabla(){

        },
        marcarInicial(){
            this.inicial=1;
            return;
        },
        
        agregarEstado(){
            var cont = this.contadorEstados
            
            if(this.selectAuto===1)
            {
                this.estadoAutomata1.label=this.estadoAutomata1.id
                if(this.estadosAutomata1.length===1)
                {
                    console.log('entro')
                    this.estadosAutomata1.push(this.estadoAutomata1);
                    this.transicionAutomata1.from='inicio'
                    this.transicionAutomata1.to=this.estadoAutomata1.id
                    this.transicionAutomata1.label=''
                    this.transicionesAutomata1.push(this.transicionAutomata1)
                    this.transicionAutomata1={from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}}
                    this.estadoAutomata1= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                    return;
                }
                else{
                    console.log("tay en el else")
                    this.estadosAutomata1.push(this.estadoAutomata1)
                    this.estadoAutomata1= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                }

            }
            else{
                this.estadoAutomata2.label=this.estadoAutomata2.id
                if(this.estadosAutomata2.length===1)
                {
                    console.log('entro')
                    this.estadosAutomata2.push(this.estadoAutomata2);
                    this.transicionAutomata2.from='inicio'
                    this.transicionAutomata2.to=this.estadoAutomata2.id
                    this.transicionAutomata2.label=''
                    this.transicionesAutomata2.push(this.transicionAutomata2)
                    this.transicionAutomata2={from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}}
                    this.estadoAutomata2= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                    return;
                }
                else{
                    console.log("tay en el else")
                    this.estadosAutomata2.push(this.estadoAutomata2)
                    this.estadoAutomata2= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                    return
                }
            }
            
            
        },

        createEstado(){

            if(this.selectAuto===1)
            {
                console.log("estado",this.estadoAutomata1);
                console.log("estados",this.estadosAutomata1);
                console.log("transicion",this.transicionAutomata1);
                console.log("transiciones",this.transicionesAutomata1);

            }
            else{
                console.log("estado",this.estadoAutomata2);
                console.log("estados",this.estadosAutomata2);
                console.log("transicion",this.transicionAutomata2);
                console.log("transiciones",this.transicionesAutomata2);
            }           
            this.validador=true;
            this.createTrans=false;
        },


        createTransicion(){
            this.createTrans=true;
            this.validador=false;
        },

        delAndClear(){  

            if(this.selectAuto===1)
            {
                var ultimo= this.estadosAutomata1.pop();
                this.estadosAutomata1.pop()
                for(var i=0; i< this.transicionesAutomata1.length;i++)
                {
                    if(this.transicionesAutomata1[i].from===ultimo.id || this.transicionesAutomata1[i].to===ultimo.id)
                    {
                        this.transicionesAutomata1.splice(i,1);
                    }
                } 

            }
            else{
                var ultimo= this.estadosAutomata2.pop();
                this.estadosAutomata2.pop()
                for(var i=0; i< this.transicionesAutomata2.length;i++)
                {
                    if(this.transicionesAutomata2[i].from===ultimo.id || this.transicionesAutomata2[i].to===ultimo.id)
                    {
                        this.transicionesAutomata2.splice(i,1);
                    }
                } 
            }
               
            console.log("Estado Eliminado");
            this.drawAutomata();
        },

        marcarFinal(id)
        {
            if(this.selectAuto===1)
            {
                  for(var i=0; i<this.estadosAutomata1.length;i++){
                    if(this.estadosAutomata1[i].id==id  && this.estadosAutomata1[i].final==false){
                        this.estadosAutomata1[i].final=true;
                        this.estadosAutomata1[i].shape='diamond';
                        this.estadosAutomata1[i].color='#5cb85c';
                        this.drawAutomata();
                        console.log("final",i ,"",this.estadosAutomata1[i].final);
                    }
                    else
                    {
                        if(this.estadosAutomata1[i].id==id  && this.estadosAutomata1[i].final==true){
                            this.estadosAutomata1[i].final=false;
                            this.estadosAutomata1[i].shape='ellipse';
                            this.estadosAutomata1[i].color='#C52C0B';
                            this.drawAutomata();
                        }
                    }
                    console.log("estado: ",this.estadosAutomata1[i].label, this.estadosAutomata1[i].final);
                } 

            }
            else{
                  for(var i=0; i<this.estadosAutomata2.length;i++){
                    if(this.estadosAutomata2[i].id==id  && this.estadosAutomata2[i].final==false){
                        this.estadosAutomata2[i].final=true;
                        this.estadosAutomata2[i].shape='diamond';
                        this.estadosAutomata2[i].color='#5cb85c';
                        this.drawAutomata();
                        console.log("final",i ,"",this.estadosAutomata2[i].final);
                    }
                    else
                    {
                        if(this.estadosAutomata2[i].id==id  && this.estadosAutomata2[i].final==true){
                            this.estadosAutomata2[i].final=false;
                            this.estadosAutomata2[i].shape='ellipse';
                            this.estadosAutomata2[i].color='#C52C0B';
                            this.drawAutomata();
                        }
                    }
                    console.log("estado: ",this.estadosAutomata2[i].label, this.estadosAutomata2[i].final);
                } 
            }
            
        },
 
        crearTransicion(){
            
            if(this.selectAuto===1){
                if(this.transicionAutomata1.from==='' || this.transicionAutomata1.to==='' )
                {
                    alert("Estados o caracter no ingresados . Rellene todos los campos antes de continuar");
                    return;
                }
                
                for(var i=0; i<this.transicionesAutomata1.length;i++)
                {
                    if(this.transicionesAutomata1[i].from===this.transicionAutomata1.from && this.transicionesAutomata1[i].label===this.transicionAutomata1.label)
                    {
                        alert("la transición ya existe. Ingrese otra");
                        return;
                    }
                    
                }
                this.addCaracterToAlfabeto();
                this.transicionesAutomata1.push(this.transicionAutomata1);
                this.transicionAutomata1={from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
            }
            else{
                if(this.transicionAutomata2.from==='' || this.transicionAutomata2.to==='' )
                {
                    alert("Estados o caracter no ingresados . Rellene todos los campos antes de continuar");
                    return;
                }
                
                for(var i=0; i<this.transicionesAutomata2.length;i++)
                {
                    if(this.transicionesAutomata2[i].from===this.transicionAutomata2.from && this.transicionesAutomata2[i].label===this.transicionAutomata2.label)
                    {
                        alert("la transición ya existe. Ingrese otra");
                        return;
                    }
                    
                }
                this.addCaracterToAlfabeto();
                this.transicionesAutomata2.push(this.transicionAutomata2);
                this.transicionAutomata2={from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};

            }
            this.drawAutomata();          
        },

        addCaracterToAlfabeto(){

            var existe=false;

            if(this.selectAuto===1)
            {
                for (var i=0; i<this.transicionesAutomata1.length;i++)
                {
                    if(existe===true && this.transicionAutomata1.label!= this.transicionesAutomata1[i].label)
                    {
                        existe=true
                    }
                    else{
                        if(this.transicionesAutomata1[i].label===this.transicionAutomata1.label)
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
                    this.alfabeto1.push(this.transicionAutomata1.label);
                }

                console.log(this.alfabeto1);
            }
            else{
                for (var i=0; i<this.transicionesAutomata2.length;i++)
                {
                    if(existe===true && this.transicionAutomata2.label!= this.transicionesAutomata2[i].label)
                    {
                        existe=true
                    }
                    else{
                        if(this.transicionesAutomata2[i].label===this.transicionAutomata2.label)
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
                    this.alfabeto1.push(this.transicionAutomata2.label);
                }

                console.log("alfabeto2: ",this.alfabeto2);
            }
            
        },
        
        /*Arrgelar esto  */
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
        /**hasta acá  */
        drawAutomata(){
            var container= document.getElementById("grafo");
            var container2= document.getElementById("grafo2");
            var data={nodes:this.estadosAutomata1,
                      edges:this.transicionesAutomata1};

            var data2={nodes:this.estadosAutomata2,
                       edges:this.transicionesAutomata2};
            var options = {
                height: 520 + 'px',
                edges:{
                    
                    arrows:'to',
                },
            };
              var options2 = {
                height: 520 + 'px',
                edges:{
                    
                    arrows:'to',
                },
            };
            var network= new vis.Network(container,data,options);
            var network2= new vis.Network(container2,data2,options2);
            
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