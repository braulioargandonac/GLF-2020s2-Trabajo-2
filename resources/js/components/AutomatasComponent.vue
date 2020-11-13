<template>
    <div>
        <h1 class="text-center textocolor fredoka mt-5 pt-4">Crear Autómata</h1> 
        
        <div class="row justify-content-center">
            <div class="grafo1 col-md-3 mx-4  card cardaux" v-if="representacion1===false">
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
                        <button class="btn btn-sm btn-success" @click="back">Volver</button>   
                    </div>         
                </div>
                <div class="container-fluid py-4 mr-4" v-if="option===1">
                    <h3 class="mt-2">Autómata Finito Determinista (AFD)</h3>
                    <hr>
                    <div class="row text-center my-4">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-success" @click="createEstado">Añadir Estado</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-success" @click="createTransicion">Añadir Transición</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-success" @click="representacion">Modificar Estado Final</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-danger" @click="delAndClear">Eliminar Autómata</button>
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
                                <input type="text" minlength="1" maxlength="1" v-model="transicionAutomata2.label" class="form-control">
                            </div>
                    
                            <button class="btn  btn-success btn-sm" type="submit" >Agregar</button>
                        </form>
                    </div>

                    <div class="col-md-6 my-4">
                        <form @submit.prevent="consultarCadena">
                            <div class="form-group">
                                <label for="">Ingrese la palabra: </label>
                                <input type="text" class="form-control" v-model="cadena">
                            </div>
                         <button class="btn btn-sm btn-success" type="submit" >Consultar Palabra</button>
                        </form>
                    </div>


                </div>
                <div class="container-fluid py-4 mr-4" v-if="option===2">
                    <h3 class="mt-2">Autómata Finito no Determinista (AFND)</h3>
                    <hr>
                     <div class="row text-center my-4">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-success" @click="createEstado">Añadir Estado</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-success" @click="createTransicion">Añadir Transición</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-success" @click="representacion">Modificar Estado Final</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-sm btn-danger" @click="delAndClear">Eliminar Autómata</button>
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
                    <div v-if="createTrans" class="my-3">

                        <form @submit.prevent="crearTransicionAFND" v-if="selectAuto===1">
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

                        <form @submit.prevent="crearTransicionAFND" v-else>
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

                    <div class="col-md-6 my-4">
                        <form @submit.prevent="consultarCadena">
                            <div class="form-group">
                                <label for="">Ingrese la palabra: </label>
                                <input type="text" class="form-control" v-model="cadena">
                            </div>
                         <button class="btn btn-sm btn-success" type="submit">Consultar Palabra</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="grafo1 col-md-8  card cardaux">
                <h3 class="text-center fredoka my-2">Representación</h3>

                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-center fredoka my-3">Autómata 1</h4>
                        <div id="grafo" class="mb-3" style="border: 1px solid lightgray;"></div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-center fredoka my-3">Autómata 2</h4>
                        <div id="grafo2" class="mb-3" style="border: 1px solid lightgray;"></div>
                    </div>
                </div>
                
            </div>
            <div class="grafo1 col-md-5 mx-3 card cardaux" v-if="representacion1===true">
                <hr>
                <div>
                    <table class="table table-striped table-dark" v-if="selectAuto===1">
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

                    <table class="table table-striped table-dark" v-if="selectAuto===2">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Estado</th> 
                            <th scope="col">Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in estadosAutomata2" :key="index">
                                <td scope="row">{{index}}</td>
                                <td>{{item.label}}</td>
                                <td>
                                    <div>             
                                        <input type="checkbox" name="state" id="state" @click="marcarFinal(item.id)" :checked="estadosAutomata2[index].final">
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
                <div class="container my-3">
                    La conversión implica pasar por un AFD intermedio con estados y transiciones redundantes, luego se eliminan los estados inaccesibles o inalcanzables, es decir, aquellos a los que no se puede acceder a partir del estado inicial. Luego de este procedimiento, se obtiene el AFD equivalente.
                </div>
            </div>

            <!--Caso 2: COMPLEMENTO -->
            <div class="cardaux2 col-md-10" v-if="operacion===2">
                <h3 class="text-center fredoka textocolor my-3">Complemento</h3>
            </div>
            <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===2">
                <div class="container my-3">
                    Esta propiedad es solo para AFD, intercambia los estados finales por no finales.
                    <div class="my-3 text-center">
                        <button class="btn btn-success" @click="drawAutomata">Mostrar Complemento</button>
                    </div>      
                    <div id="complemento" class="mb-3" style="border: 1px solid lightgray;"></div>
                </div>
            </div>

            <!--Caso 3: UNION -->
            <div class="cardaux2 col-md-10" v-if="operacion===3" >
                <h3 class="text-center fredoka textocolor my-3">Unión</h3>
            </div>
            <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===3">
                <div class="container my-3">
                    La unión de dos lenguajes regulares es otro lenguaje regular, donde se utiliza la operación de unión de conjuntos, de manera que, Σ = {x,y} si L1 = {x,xy} y L2 = {yx,yy} la unión es L1UL2 = {x,xy,yx,yy}.
                    <div class="my-3 text-center">
                        <button class="btn btn-success" @click="drawAutomata">Mostrar unión</button>
                    </div>      
                    <div id="union" class="mb-3" style="border: 1px solid lightgray;"></div>
                </div>
            </div>

            <!--Caso 4: CONCATENACION -->
            <div class="cardaux2 col-md-10" v-if="operacion===4">
                <h3 class="text-center fredoka textocolor my-3">Concatenación</h3>
            </div>
            <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===4">
                <div class="container my-3">
                    Se concatena una una cadena del primer lenguaje y una cadena del segundo lenguaje.
                    <div class="my-3 text-center">
                        <button class="btn btn-success" @click="drawAutomata">Mostrar concatenación</button>
                    </div>      
                    <div id="concatenacion" class="mb-3" style="border: 1px solid lightgray;"></div>
                </div>
            </div>

            <!--Caso 5: INTERSECCION -->
            <div class="cardaux2 col-md-10" v-if="operacion===5">
                <h3 class="text-center fredoka textocolor my-3">Intersección</h3>
            </div>
            <div id="afd-equivalente" class="card cardaux3 col-md-10 rounded-bottom mb-3" v-if="operacion===5">
                <div class="container my-3">
                    La intersección de ambos lenguajes utiliza la operación de interseccion de conjuntos, Automata1 ∩ Automata2: 
                    <div class="my-3 text-center">
                        <button class="btn btn-success" @click="drawAutomata">Mostrar Intersección</button>
                    </div>      
                    <div id="interseccion" class="mb-3" style="border: 1px solid lightgray;"></div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" @click="simplificarAFD(estadosAutomata1)">SIMPLIFICA LA WEA 1</button>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" @click="simplificarAFD(estadosAutomata2)">SIMPLIFICA LA WEA 2</button>
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
            
            
            automataUnion: [{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            transicionUnion:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesUnion:[],

            automataConcatenacion:[{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            estadoConcatenacion:{id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'},
            transicionConcatenacion:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesConcatenacion:[],

            automataComplemento:[],
            estadoComplemento:{id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'},
            transicionComplemento:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesComplemento:[],

            automataInterseccion:[{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            transicionInterseccion:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesInterseccion:[],
            
            automataEquivalente:[{id:'inicio', label:'inicio',color:'#75616b47', final:false}],
            transicionEquivalente:{from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}},
            transicionesEquivalente:[],

            cadena:'',

            matriz1AFND: [],
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
            if(this.existeFinales())
            {
                this.operacion=1;
                this.afdEquivalente();
                return;               
            }
            else{
                alert("Para proseguir debe marcar como final un estado final en los dos autómatas");
                return;
            }
        },
        
        mostrarOp2(){
            if(this.existeFinales())
            {
                this.operacion=2;
                this.complemento();
                return;
            }
            else{
                alert("Para proseguir debe marcar como final un estado final en los dos autómatas");
                return;
            }
        },

        mostrarOp3(){
            if(this.existeFinales())
            {
                this.operacion=3;
                this.automataUnion= [{id:'inicio', label:'inicio',color:'#75616b47', final:false}];
                this.transicionUnion= {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                this.transicionesUnion= [];
                this.union();
                this.crearMatrizTransiciones(this.transicionesAutomata2);
                this.crearMatrizTransiciones(this.transicionesAutomata1);
                return;
            }
            else{
                swal("Para proseguir debe marcar como final un estado final en los dos autómatas",{
                    className: "alertas",
                    button:'Aceptar',
                    title:"Aviso",
                });
                return;
            }
        },

        mostrarOp4(){
            if(this.existeFinales())
            {
                this.operacion=4;
                this.concatenacion();
                return;
            }
            else{
                swal("Para proseguir debe marcar como final un estado final en los dos autómatas",{
                    className: "alertas",
                    button:'Aceptar',
                    title:"Aviso",
                });
                return;
            }
        },

        mostrarOp5(){
            if(this.existeFinales())
            {
                this.operacion=5;
                this.interseccion();
                return;
            }
            else{
                swal("Para proseguir debe marcar como final un estado final en los dos autómatas",{
                    className: "alertas",
                    button:'Aceptar',
                    title:"Aviso",
                });
                return;
            }
        },
        mostrartabla(){
            
        },
        marcarInicial(){
            this.inicial=1;
            return;
        },
        
        consultarCadena(){
            var word=this.cadena.split('');
            var transicionesEstadoActual=[];
            var estadoActual;
            console.log(word);
            if(this.selectAuto===1)
            {
                estadoActual=this.estadosAutomata1[1].id;
                console.log(estadoActual);
                for(var i=0;i<word.length;i++)
                {
                    if(!this.existeCaracter(word[i]))
                    {
                        alert('La palabra no pertenence al lenguaje');
                        return;
                    }
                    //llena con las transiciones que corresponden del estado actual
                    for(var j=0; j<this.transicionesAutomata1.length;j++)
                    {
                        if(this.transicionesAutomata1[j].from==estadoActual)
                        {
                            transicionesEstadoActual.push(this.transicionesAutomata1[j]);
                        }
                    }
                    //recorre las transiciones del estado actual para pasar al otro de acuerdo al caracter actual
                    for(var k=0; k<transicionesEstadoActual.length;k++)
                    {
                        if(transicionesEstadoActual[k].label==word[i])
                        {
                            estadoActual=transicionesEstadoActual[k].to;
                            console.log('estado actual: ', estadoActual);
                        }
                    }
                    transicionesEstadoActual=[];
                }

                for(var l=0; l<this.estadosAutomata1.length;l++)
                {
                    if(estadoActual===this.estadosAutomata1[l].id)
                    {
                        if(this.estadosAutomata1[l].final==true)
                        {
                            alert('la palabra pertenece al lenguaje');
                            return
                        }
                        else
                        {
                            alert('la palabra no pertenece al lenguaje')
                            return
                        }  
                    }
                }                        
            }  
            else{
                estadoActual=this.estadosAutomata2[1].id;
                console.log(estadoActual);
                for(var i=0;i<word.length;i++)
                {
                    if(!this.existeCaracter(word[i]))
                    {
                        alert('La palabra no pertenence al lenguaje');
                        return;
                    }
                    //llena con las transiciones que corresponden del estado actual
                    for(var j=0; j<this.transicionesAutomata2.length;j++)
                    {
                        if(this.transicionesAutomata2[j].from==estadoActual)
                        {
                            transicionesEstadoActual.push(this.transicionesAutomata2[j]);
                        }
                    }
                    //recorre las transiciones del estado actual para pasar al otro de acuerdo al caracter actual
                    for(var k=0; k<transicionesEstadoActual.length;k++)
                    {
                        if(transicionesEstadoActual[k].label==word[i])
                        {
                            estadoActual=transicionesEstadoActual[k].to;
                            console.log('estado actual: ', estadoActual);
                        }
                    }
                    transicionesEstadoActual=[];
                }

                for(var l=0; l<this.estadosAutomata2.length;l++)
                {
                    if(estadoActual===this.estadosAutomata2[l].id)
                    {
                        if(this.estadosAutomata2[l].final==true)
                        {
                            alert('la palabra pertenece al lenguaje');
                            return
                        }
                        else
                        {
                            alert('la palabra no pertenece al lenguaje')
                            return
                        }  
                    }
                } 
            }    
        },

        existeCaracter(caracter){
            if(this.selectAuto===1)
            {
                for(var i=0;i<this.alfabeto1.length;i++)
                {
                    if(this.alfabeto1[i]==caracter)
                    {
                        return true
                    }
                }
                return false;
            }
            else{
                for(var i=0;i<this.alfabeto2.length;i++)
                {
                    if(this.alfabeto2[i]==caracter)
                    {
                        return true
                    }
                }
                return false;

            }
        },

        agregarEstado(){
            var aux= {id:'inicio', label:'inicio',color:'#75616b47', final:false}

            if(this.selectAuto===1)
            {
                if(this.estadoAutomata1.id==='')
                {
                    alert("Por favor, ingrese un id.");
                    return;
                }
                if(this.existeEstado(this.estadosAutomata1,this.estadoAutomata1))
                {
                    alert("El estado ya existe. Ingrese un estado con otro id.");
                    return;
                }
                if(this.estadosAutomata1.length===0)
                {
                    this.estadosAutomata1.push(aux);
                }
                this.estadoAutomata1.label=this.estadoAutomata1.id
                if(this.estadosAutomata1.length===1)
                {
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
                    this.estadosAutomata1.push(this.estadoAutomata1)
                    this.estadoAutomata1= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                }

            }
            else{
                if(this.estadoAutomata2.id==='') 
                {
                    alert("Por favor, ingrese un id.");
                    return;
                }
                if(this.estadosAutomata2.length===0)
                {
                    this.estadosAutomata2.push(aux);
                }
                this.estadoAutomata2.label=this.estadoAutomata2.id
                if(this.estadosAutomata2.length===1)
                {
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
                    this.estadosAutomata2.push(this.estadoAutomata2)
                    this.estadoAutomata2= {id:'', label:'',color:'#C52C0B' ,final:false}
                    this.drawAutomata()
                    return
                }
            }
            
            
        },

        existeEstado(estados,estado)
        {
            for(var i=0; i<estados.length;i++)
            {
                if(estados[i].id===estado.id)
                {
                    return true;
                }
            }
            return false;
        },

        existeFinales(){
            var existe1=false;
            var existe2=false;

            for(var i=0; i<this.estadosAutomata1.length;i++)
            {
                if(this.estadosAutomata1[i].
                final===true)
                {
                    existe1=true;
                }
                else{
                    if(this.estadosAutomata1[i].final===false && existe1===true)
                    {
                        existe1=true;
                    }
                    else{
                        if(this.estadosAutomata1[i].final===false && existe1===false)
                        {
                            existe1=false;
                        }
                    }
                }
            }

            for(var j=0; j<this.estadosAutomata2.length;j++)
            {
                if(this.estadosAutomata2[j].final===true)
                {
                    existe2=true;
                }
                else{
                    if(this.estadosAutomata2[j].final===false && existe2===true)
                    {
                        existe2=true;
                    }
                    else{
                        if(this.estadosAutomata2[j].final===false && existe2===false)
                        {
                            existe2=false;
                        }
                    }
                }
            }

            if(existe1 && existe2)
            {
                return true;
            }
            return false;
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
                this.estadosAutomata1=[]
                this.transicionesAutomata1=[]

            }
            else{
                this.estadosAutomata2=[]
                this.transicionesAutomata2=[]   
            }
               
            console.log("Automata Eliminado");
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

        crearTransicionAFND(){           
            if(this.selectAuto===1){
                if(this.transicionAutomata1.from==='' || this.transicionAutomata1.to==='' )
                {
                    alert("Estados o caracter no ingresados . Rellene todos los campos antes de continuar");
                    return;
                }
                if(this.existeTransicion(this.transicionesAutomata1,this.transicionAutomata1))
                {
                   alert("la transición ya existe. Ingrese otra");
                   return;
                }
                else{
                    for(var i=0; i<this.transicionesAutomata1.length;i++)
                    {
                        if(this.transicionesAutomata1[i].from===this.transicionAutomata1.from && this.transicionesAutomata1[i].label!=this.transicionAutomata1.label && this.transicionesAutomata1[i].to===this.transicionAutomata1.to){
                            var aux = [this.transicionesAutomata1[i].label, this.transicionAutomata1.label]
                            console.log("aux:", aux);
                            this.transicionesAutomata1[i].label= aux[0]+','+aux[1];
                            console.log("label",this.transicionesAutomata1[i].label);
                            this.drawAutomata();
                            this.addCaracterToAlfabeto();
                            return;    
                        }                    
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

                if(this.existeTransicion(this.transicionesAutomata2,this.transicionAutomata2))
                {
                   alert("la transición ya existe. Ingrese otra");
                   return;
                }
                else{
                    for(var i=0; i<this.transicionesAutomata2.length;i++)
                    {
                        if(this.transicionesAutomata2[i].from===this.transicionAutomata2.from && this.transicionesAutomata2[i].label!=this.transicionAutomata2.label && this.transicionesAutomata2[i].to===this.transicionAutomata2.to)
                        {
                            var aux = [this.transicionesAutomata2[i].label, this.transicionAutomata2.label]
                            console.log("aux:", aux);
                            this.transicionesAutomata2[i].label= aux[0]+','+aux[1];
                            console.log("label",this.transicionesAutomata2[i].label);
                            this.drawAutomata();
                            this.addCaracterToAlfabeto();
                            return;   
                        }        
                    }     
                }          
                this.addCaracterToAlfabeto();
                this.transicionesAutomata2.push(this.transicionAutomata2);
                this.transicionAutomata2={from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
            }
            this.drawAutomata(); 
        },

        existeTransicion(transiciones,transicion)
        {
            for(var i=0; i<transiciones.length;i++)
            {
                if(transiciones[i].from===transicion.from && transiciones[i].to === transicion.to && transiciones[i].label===transicion.label)
                {
                    return true;
                }
            }
            return false;

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

                console.log("alfabeto1",this.alfabeto1);
            }
            else{
                for (var i=0; i<this.transicionesAutomata2.length;i++) // a, b, b, a
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
                    this.alfabeto2.push(this.transicionAutomata2.label);
                }
                

                console.log("alfabeto2: ",this.alfabeto2);
            }
            
        },
        

        crearMatrizTransiciones(transiciones){
            var res = [];
            for(var i=0; i<3;i++){
                res[i]= new Array(transiciones.length);
            }
            for(var t=1; t<transiciones.length;t++){
                res[0][t]=transiciones[t].from
                res[1][t]=transiciones[t].label
                res[2][t]=transiciones[t].to
            }
        
            console.log("Matriz ",res);
            return res;
        },

        matrizTransicionesUnion()
        {
            console.log("funcion matriz transiciones union");
            var matAuto1= this.crearMatrizTransiciones(this.transicionesAutomata1);
            var matAuto2= this.crearMatrizTransiciones(this.transicionesAutomata2); 
            var strId;
            var matrix=[];
            var union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
            var transicion, transicion2;
            var to1, to2;
            console.log(this.automataUnion);
            for(let i=1;i<this.automataUnion.length; i++){
                strId = this.automataUnion[i].id.split(','); 
                for(var j=1; j<=matAuto1.length;j++)
                {
                    if(strId[0]===matAuto1[0][j])
                    {
                        transicion=matAuto1[1][j];
                        to1=matAuto1[2][j];
                        var arraytransicion= transicion.split(',');
                        if (arraytransicion.length>1){
                            for(var m=0; m<arraytransicion.length; m++){
                                transicion= arraytransicion[m]
                                for(var k=1; k<=matAuto2.length;k++){
                                    transicion2=matAuto2[1][k];
                                    var arraytransicion2= transicion2.split(',');
                                    if(arraytransicion2.length>1){   //a,b - a,b
                                        for(var o=0; o<arraytransicion2.length; o++){
                                            transicion2= arraytransicion2[o];
                                            if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                                to2=matAuto2[2][k];
                                                union.from=strId[0]+','+strId[1];
                                                union.label=transicion;
                                                union.to=to1+','+to2;
                                                console.log("union 1",union);
                                                matrix.push(union);
                                                union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                            }
                                        }
                                    }else{                              //a,b - a
                                        if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                            to2=matAuto2[2][k];
                                            union.from=strId[0]+','+strId[1];
                                            union.label=transicion;
                                            union.to=to1+','+to2;
                                            console.log("union 2",union);
                                            matrix.push(union);
                                            union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                        }
                                    }
                                }
                            }
                            
                        }else{ //a - a, b      y a - a
                            for(var k=1; k<=matAuto2.length;k++){
                                transicion2=matAuto2[1][k];
                                var arraytransicion2= transicion2.split(',');
                                if(arraytransicion2.length>1){   //a,b - a,b
                                    for(var o=0; o<arraytransicion2.length; o++){
                                        transicion2= arraytransicion2[o];
                                        if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                            to2=matAuto2[2][k];
                                            union.from=strId[0]+','+strId[1];
                                            union.label=transicion;
                                            union.to=to1+','+to2;
                                            console.log("union 3",union);
                                            matrix.push(union);
                                            union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                        }
                                    }
                                }else{                              //a,b - a
                                    if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                        to2=matAuto2[2][k];
                                        union.from=strId[0]+','+strId[1];
                                        union.label=transicion;
                                        union.to=to1+','+to2;
                                        console.log("union 4",union);
                                        matrix.push(union);
                                        union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                    }
                                }
                            }
                        }
                    }
                }           
            }
            console.log(matrix);
            this.transicionesUnion=matrix;
        },
        

        compararAlfabetos()
        {
            var cont=0;
            for(var i=0; i< this.alfabeto1.length; i++)
            {
                for(var j=0; j< this.alfabeto2.length; j++)
                {
                    if(this.alfabeto1[i]==this.alfabeto2[j])
                    {
                        cont++;
                    }
                }
            }
            if(cont== this.alfabeto1.length && cont== this.alfabeto2.length)
            {
                return true;
            }
            return false;
        },

        union(){
            var auto1= this.transicionesAutomata1
            var auto2 =this.transicionesAutomata2
            console.log("alfabeto 1", this.alfabeto1);
            console.log("alfabeto 2", this.alfabeto2);
            var autoUnion = '';
            var autoaux = {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'}
            this.alfabeto1=this.simplificarAlfabeto(this.alfabeto1);
            this.alfabeto2=this.simplificarAlfabeto(this.alfabeto2);
            if(this.compararAlfabetos()){
                var nuevoAlfabeto = this.alfabeto1;
                for(var i=1 ; i<this.estadosAutomata1.length ;i++){
                    for(var k=1; k<this.estadosAutomata2.length; k++){
                        autoaux.label=this.estadosAutomata1[i].label+this.estadosAutomata2[k].label;
                        autoaux.id=this.estadosAutomata1[i].label+','+this.estadosAutomata2[k].label;
                        if(this.estadosAutomata1[i].final==true || this.estadosAutomata2[k].final==true){
                            autoaux.final=true;
                            autoaux.shape='diamond';
                            autoaux.color='#5cb85c';
                        }
                        this.automataUnion.push(autoaux);
                        console.log(this.automataUnion);  
                        
                        autoaux = {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'};
                    }
                }        
                this.matrizTransicionesUnion();
                this.transicionUnion.from='inicio';
                this.transicionUnion.label='';
                this.transicionUnion.to=this.automataUnion[1].id;
                this.transicionesUnion.push(this.transicionUnion);
                console.log(this.transicionesUnion);
            }
            else{
                var nuevoAlfabeto = this.alfabeto1.concat(this.alfabeto2);
                var purgado= this.simplificarAlfabeto(nuevoAlfabeto);
                nuevoAlfabeto=purgado;
                console.log("nuevo Alfabeto:",nuevoAlfabeto);
                for(var i=1; i<this.estadosAutomata1.length; i++)
                {
                    for(j=1;j<this.estadosAutomata2.length;j++)
                    {
                        
                    }
                }
            }
        },

        simplificarAlfabeto(alfabeto){
            
            var newArr = [];
            var myObj = {};
            alfabeto.forEach(el => {      
                if (!(el in myObj)) { 
                    myObj[el] = true
                    newArr.push(el)
                }
            });
                        
            console.log(newArr);
            return newArr;
        },
        
        drawAutomata(){
            var container= document.getElementById("grafo");
            var container2= document.getElementById("grafo2");
            var containerUnion= document.getElementById("union");
            var containerInterseccion= document.getElementById("interseccion");
            var containerComplemento= document.getElementById("complemento");
            var containerConcatenacion= document.getElementById("concatenacion");
            var containerEquivalente= document.getElementById("equivalente");

            var data={nodes:this.estadosAutomata1,
                      edges:this.transicionesAutomata1};

            var data2={nodes:this.estadosAutomata2,
                       edges:this.transicionesAutomata2};
            
            var dataUnion={nodes:this.automataUnion,
                           edges:this.transicionesUnion};
            
            var dataInterseccion={nodes:this.automataInterseccion,
                                  edges:this.transicionesInterseccion};
            
            var dataComplemento={nodes:this.automataComplemento,
                                 edges:this.transicionesComplemento};

            var dataConcatenacion={nodes:this.automataConcatenacion,
                                   edges:this.transicionesConcatenacion};
            
            var dataEquivalente={nodes:this.automataEquivalente,
                                 edges:this.transicionesEquivalente};

            var options = {
                height: 320 + 'px',
                
                edges:{
                    
                    arrows:'to',
                },
            };

    

            var network= new vis.Network(container,data,options);
            var network2= new vis.Network(container2,data2,options);

            if(this.operacion===1)
            {
                var networkEquivalente= new vis.Network(containerEquivalente,dataEquivalente,options);
            }
            if(this.operacion===2)
            {
                var networkComplemento= new vis.Network(containerComplemento,dataComplemento,options);
            }
            if(this.operacion===3)
            {
                var networkUnion= new vis.Network(containerUnion,dataUnion,options);
            }
            if(this.operacion===4)
            {
                var networkConcatenacion= new vis.Network(containerConcatenacion,dataConcatenacion,options);
            }
            if(this.operacion===5)
            {
                var networkInterseccion= new vis.Network(containerInterseccion,dataInterseccion,options);
            }
            
        },

        matrizAFND(){
            var alfabeto= this.simplificarAlfabeto(this.alfabeto1); //['a','b','c']
            var matAuto1= this.crearMatrizTransiciones(this.transicionesAutomata1); 
            var matAuto2= this.crearMatrizTransiciones(this.transicionesAutomata2); 
            var est1 = this.estadosAutomata1
            var est2 = this.estadosAutomata2
            var estadosaux = [] // [ inicio, aux]  [1, [[a],[1,2,3]]]
            var aux = [];       // transicion, fin  [a], [1,2,3]
            var fin= [];        //finales [ 1,2,3 ]
            var matriz = [];       //largo estados * Largo Alfabeto
            //console.log("ALFABETOOO",alfabeto);
            
            for(var i=1; i<est1.length;i++){ //inicio
                estadosaux.push(est1[i].id);
                for(var j=0; j<alfabeto.length; j++){ //alfabeto
                    aux.push(alfabeto[j]);
                    for(var k=1; k<matAuto1[0].length; k++){  //fin
                        if(matAuto1[1][k].length>1){
                            for(var m=0; m < matAuto1[1][k].length; m++){
                                if(est1[i].id == matAuto1[0][k] && matAuto1[1][k][m] == alfabeto[j]){
                                    fin.push(matAuto1[2][k]);
                                }
                            }
                        }else{
                            if(est1[i].id == matAuto1[0][k] && matAuto1[1][k] == alfabeto[j]){
                                fin.push(matAuto1[2][k]);
                            }
                        }
                    }
                    aux.push(fin);
                    fin=[];
                    estadosaux.push(aux);
                    aux=[];
                }
                matriz.push(estadosaux)
                estadosaux = []
            }
            console.log(matriz);
            this.matriz1AFND=matriz;
        },


        afdEquivalente(){
            this.matrizAFND();
            console.log(this.matriz1AFND);
            var matriz1=this.matriz1AFND;
            var matriz2=[];
            var estadoaux = []; // [ inicio, aux]  [1, [[a],[1,2,3]]]
            var transicionaux = [];    // transicion, fin  [a], [1,2,3]
            var trans=[];
            var finaux= [];        // [1,2,3]
            var finaux2= []; 
            var abc = this.simplificarAlfabeto(this.alfabeto1);
            matriz2.push(matriz1[0]);
            console.log("formato de la wea", matriz1);
            if(matriz2[0][1][1].length>1){ //[1,[a,[[2,3]]] ]
                trans=matriz2[0][1][1];
                transicionaux.push(trans);
                for(var l=1; l<=abc.length; l++){
                    trans=matriz2[0][l][0];
                    console.log("trans", trans);
                    finaux.push(trans);
                    for(var p=0;p<matriz2[0][1][1].length;p++){
                        for(var t=0; t<matriz1.length; t++){
                            if(matriz2[0][1][1][p]==matriz1[t][0]){
                                for(var y=1; y<=abc.length; y++){
                                    console.log("Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                    if(trans==matriz1[t][y][0]){
                                        console.log("valores: ",matriz1[0][1][1][p]);
                                        finaux2.push(matriz1[0][1][1][p]);
                                    }
                                }
                            }
                        }
                    }
                    finaux.push(finaux2);
                    finaux2= [];
                    transicionaux.push(finaux);
                    finaux= [];
                }
                estadoaux.push(transicionaux);
            }
            console.log("la wea que explota",estadoaux);
        },

        complemento(){
            if(this.selectAuto===1)
            {
                this.automataComplemento=this.estadosAutomata1;
                this.transicionesComplemento=this.transicionesAutomata1;
                for(var i=0; i<this.automataComplemento.length; i++)
                {
                    if(this.automataComplemento[i].final===true)
                    {
                        this.automataComplemento[i].final=false;
                        this.automataComplemento[i].shape='ellipse';
                        this.automataComplemento[i].color='#C52C0B';
                    }
                    else{
                        this.automataComplemento[i].final=true;
                        this.automataComplemento[i].shape='diamond';
                        this.automataComplemento[i].color='#5cb85c';
                    }
                }
            }
            else{
                this.automataComplemento=this.estadosAutomata2;
                this.transicionesComplemento=this.transicionesAutomata2;
                for(var i=0; i<this.automataComplemento.length; i++)
                {
                    if(this.automataComplemento[i].final===true)
                    {
                        this.automataComplemento[i].final=false;
                        this.automataComplemento[i].shape='ellipse';
                        this.automataComplemento[i].color='#C52C0B';
                    }
                    else{
                        this.automataComplemento[i].final=true;
                        this.automataComplemento[i].shape='diamond';
                        this.automataComplemento[i].color='#5cb85c';
                    }
                }             
            }
        },

        concatenacion(){
            if(this.selectAuto==1){
                for(var i=0; i<this.estadosAutomata1.length;i++)
                {
                    if(this.estadosAutomata1[i].final===true)
                    {
                        this.estadosAutomata1[i].final=false;
                        this.estadosAutomata1[i].shape='ellipse';
                        this.estadosAutomata1[i].color='#C52C0B';
                        this.automataConcatenacion=this.estadosAutomata1.concat(this.estadosAutomata2);
                        this.transicionesConcatenacion=this.transicionesAutomata1.concat(this.transicionesAutomata2);
                        this.transicionConcatenacion.from=this.estadosAutomata1[i].id;
                        this.transicionConcatenacion.label='';
                        this.transicionConcatenacion.to=this.estadosAutomata2[1].id;
                    }
                }      
            }
            else{ 
                for(var i=0; i<this.estadosAutomata2.length;i++)
                {
                    if(this.estadosAutomata2[i].final===true)
                    {
                        this.estadosAutomata2[i].final=false;
                        this.estadosAutomata2[i].shape='ellipse';
                        this.estadosAutomata2[i].color='#C52C0B';
                        this.automataConcatenacion=this.estadosAutomata2.concat(this.estadosAutomata1);
                        this.transicionesConcatenacion=this.transicionesAutomata2.concat(this.transicionesAutomata1);
                        this.transicionConcatenacion.from=this.estadosAutomata2[i].id;
                        this.transicionConcatenacion.label='';
                        this.transicionConcatenacion.to=this.estadosAutomata1[1].id;
                    } 
                }   
            }
            console.log("estados concat", this.automataConcatenacion);
            console.log("transiciones concat: ", this.transicionesConcatenacion);
        },

        interseccion(){
            var auto1= this.transicionesAutomata1
            var auto2 =this.transicionesAutomata2
            contsole.log("alfabeto 1", this.alfabeto1);
            console.log("alfabeto 2", this.alfabeto2);
            var autoUnion = '';
            var autoaux = {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'}
            this.alfabeto1=this.simplificarAlfabeto(this.alfabeto1);
            this.alfabeto2=this.simplificarAlfabeto(this.alfabeto2);
            if(this.compararAlfabetos()){
                var nuevoAlfabeto = this.alfabeto1;
                for(var i=1 ; i<this.estadosAutomata1.length ;i++){
                    for(var k=1; k<this.estadosAutomata2.length; k++){
                        autoaux.label=this.estadosAutomata1[i].label+this.estadosAutomata2[k].label;
                        autoaux.id=this.estadosAutomata1[i].label+','+this.estadosAutomata2[k].label;
                        if(this.estadosAutomata1[i].final==true && this.estadosAutomata2[k].final==true){
                            autoaux.final=true;
                            autoaux.shape='diamond';
                            autoaux.color='#5cb85c';
                        }
                        this.automataInterseccion.push(autoaux);
                        console.log(this.automataInterseccion);  
                        
                        autoaux = {id:'', label:'',color:'#C52C0B', final:false, shape:'ellipse'};
                    }
                }        
                this.matrizTransicionesInterseccion();
                this.transicionInterseccion.from='inicio';
                this.transicionInterseccion.label='';
                this.transicionInterseccion.to=this.automataInterseccion[1].id;
                this.transicionesInterseccion.push(this.transicionInterseccion);
                console.log(this.transicionesInterseccion);
            }
            else{
                var nuevoAlfabeto = this.alfabeto1.concat(this.alfabeto2);
                var purgado= this.simplificarAlfabeto(nuevoAlfabeto);
                nuevoAlfabeto=purgado;
                console.log("nuevo Alfabeto:",nuevoAlfabeto);
                for(var i=1; i<this.estadosAutomata1.length; i++)
                {
                    for(j=1;j<this.estadosAutomata2.length;j++)
                    {
                        
                    }
                }
            }
        },

        matrizTransicionesInterseccion()
        {
            console.log("funcion matriz transiciones union");
            var matAuto1= this.crearMatrizTransiciones(this.transicionesAutomata1);
            var matAuto2= this.crearMatrizTransiciones(this.transicionesAutomata2); 
            var strId;
            var matrix=[];
            var union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
            var transicion, transicion2;
            var to1, to2;
            console.log(this.automataInterseccion);
            for(let i=1;i<this.automataInterseccion.length; i++){
                strId = this.automataInterseccion[i].id.split(','); 
                for(var j=1; j<=matAuto1.length;j++)
                {
                    if(strId[0]===matAuto1[0][j])
                    {
                        transicion=matAuto1[1][j];
                        to1=matAuto1[2][j];
                        var arraytransicion= transicion.split(',');
                        if (arraytransicion.length>1){
                            for(var m=0; m<arraytransicion.length; m++){
                                transicion= arraytransicion[m]
                                for(var k=1; k<=matAuto2.length;k++){
                                    transicion2=matAuto2[1][k];
                                    var arraytransicion2= transicion2.split(',');
                                    if(arraytransicion2.length>1){   //a,b - a,b
                                        for(var o=0; o<arraytransicion2.length; o++){
                                            transicion2= arraytransicion2[o];
                                            if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                                to2=matAuto2[2][k];
                                                union.from=strId[0]+','+strId[1];
                                                union.label=transicion;
                                                union.to=to1+','+to2;
                                                console.log("union 1",union);
                                                matrix.push(union);
                                                union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                            }
                                        }
                                    }else{                              //a,b - a
                                        if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                            to2=matAuto2[2][k];
                                            union.from=strId[0]+','+strId[1];
                                            union.label=transicion;
                                            union.to=to1+','+to2;
                                            console.log("union 2",union);
                                            matrix.push(union);
                                            union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                        }
                                    }
                                }
                            }
                            
                        }else{ //a - a, b      y a - a
                            for(var k=1; k<=matAuto2.length;k++){
                                transicion2=matAuto2[1][k];
                                var arraytransicion2= transicion2.split(',');
                                if(arraytransicion2.length>1){   //a,b - a,b
                                    for(var o=0; o<arraytransicion2.length; o++){
                                        transicion2= arraytransicion2[o];
                                        if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                            to2=matAuto2[2][k];
                                            union.from=strId[0]+','+strId[1];
                                            union.label=transicion;
                                            union.to=to1+','+to2;
                                            console.log("union 3",union);
                                            matrix.push(union);
                                            union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                        }
                                    }
                                }else{                              //a,b - a
                                    if(strId[1]===matAuto2[0][k] && transicion2==transicion){
                                        to2=matAuto2[2][k];
                                        union.from=strId[0]+','+strId[1];
                                        union.label=transicion;
                                        union.to=to1+','+to2;
                                        console.log("union 4",union);
                                        matrix.push(union);
                                        union = {from:'',label: '',to:'',color:{color:'rgb(0,0,0)'}};
                                    }
                                }
                            }
                        }
                    }
                }           
            }
            console.log(matrix);
            this.transicionesInterseccion=matrix;
        },

        simplificarAFD(estados){
            var res = [];
            // Se crea la matriz
            for(var i=0; i<estados.length;i++){
                res[i]= new Array(estados.length);
            }
            
            //Se marcan con x todos los estados que no pueden simplificar entre si y con 0 la diagonal
            for(var n=0; n<estados.length; n++){
                for(var m=0; m<estados.length; m++){
                    if(n=m){
                        res[n][m]='x';
                    }
                    if(estados[n].final!=estados.final[m]){
                        res[n][m]='x';
                        res[m][n]='x';
                    }
                }
            }

            for(var k=0; k<estados.length; k++){
                for(var l=0; l<estados.length; l++){
                    if(res[k][l]!='x'){
                        
                    }
                }
            }
            

        },
    
    },

}
</script>