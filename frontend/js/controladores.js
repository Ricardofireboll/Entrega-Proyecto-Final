

    // Ventana Registro
    function ventanaNombre(){
        document.getElementById('registroPagina-1').style.display = "none";
        document.getElementById('registroPagina-2').style.display = "block";
        document.getElementById('footer').style.bottom = "1px";
        
    }
    function ventanaPais(){
        document.getElementById('registroPagina-2').style.display = "none";
        document.getElementById('registroPagina-3').style.display = "block";
        document.getElementById('footer').style.bottom = "1px";
        document.getElementById('titulo-bienvenida').innerHTML = 
        `
        ¡Te damos la bienvenida, ${document.getElementById('txt-nombre').value}!<br><span style="text-align: center; color:#adadad; font-size: 18px;">vamos a empezar por crear tu perfil, conectar con otras personas que conoces <br>y habla de temas que te interesan.</span>
        `
        
    }

    function ventanaCarrera(){
        document.getElementById('registroPagina-3').style.display = "none";
        document.getElementById('registroPagina-4').style.display = "block";
        document.getElementById('footer').style.marginTop = "10px";
        for (let i = 2010; i <= 2030; i++) {
            document.getElementById('añoI').innerHTML +=
            `
            <option value="">${i}</option>
            `;
            document.getElementById('añoF').innerHTML +=
            `
            <option value="">${i}</option>
            `;
            
        }
    }



    // Ventana login

    var accesoUsuario;
    var usuarioActual;


    function login(){
        axios({
            url:'../backend/api/login.php',
            method: 'post',
            responseType: 'json',
            data:{
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            }
        }).then(res=>{
            accesoUsuario = res.data;
            console.log(accesoUsuario);
            if (res.data.codigoResultado == 1) {
                window.location.href = "home.html";
            }else{
                console.log('Los datos ingresados no soncorrectos');
                
            }
            console.log(res.data);
        }).catch(error=>{
            console.error(error);
        });

    }


    // Ventana home
    var idUsuarioActual;

    function leerCookie(nombre) {
        var lista = document.cookie.split(";");
        for (i in lista) {
            var busca = lista[i].search(nombre);
            if (busca > -1) {micookie=lista[i]}
            }
        var igual = micookie.indexOf("=");
        var valor = micookie.substring(igual+1);
        return valor;
        }
        
    function cargarUsuarioActual(){
        var emailUsuario = leerCookie('email');
        var passwordUsuario = leerCookie('password');
        axios({
            url:'../backend/api/usuarios.php?email='+emailUsuario+'&password='+passwordUsuario,
            method: 'get',
            responseType: 'json',
        }).then(res=>{
            usuarioActual = res.data;
            idUsuarioActual = usuarioActual.codigoUsuario;
            cargarPublicaciones(idUsuarioActual);
            console.log('Usuario id',idUsuarioActual);
            console.log('Usuario Actual',usuarioActual);
            document.getElementById('perfil-1').innerHTML = '';
            document.getElementById('perfil-1').innerHTML =
            `
            <div class="card" style="border-radius: 10px 10px 0.25rem 0.25rem;">
                <img src="${usuarioActual.imgFondo}" class="card-img-top" alt="error" style="height: 65px; border-radius: 10px 10px 0px 0px;" >
                <img src="${usuarioActual.imgPerfil}" class="img-info-perfil" alt="error">
                <div class="card-body" style="padding-top: 0px; margin-top: -30px;">
                    <h5 class="card-title" style="text-align: center;">${usuarioActual.nombre} ${usuarioActual.apellidos}</h5>
                    <p class="card-text" style="text-align: center; font-size: 10px;font-weight: 100;">${usuarioActual.institucionEducativa}</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><span>Contacto <br>Amplia su red</span><i style="font-size: 15px;float: right; cursor: pointer;" class="fas fa-user-friends" ></i></li>
                <li class="list-group-item"><i class="fas fa-bookmark" style="font-size: 14px; margin-right: 10px; color: #adb5bd;"></i><span style="font-size: 13px;">Marcart paginas</span></li>
                </ul>
            </div>
            `;

            document.getElementById('crear-publicacion').innerHTML = '';
            document.getElementById('crear-publicacion').innerHTML =
            `
            <img src="${usuarioActual.imgPerfil}" class="img-crear-publicacion" alt="error">
            <button id="btn-publicar" class="btn btn-redondeado">Crear publicación</button><br>
            <div>
                <i class="icon-publicar far fa-image" style="color: #70B5F9; "><span style="margin-left: 5px;">Foto</span></i>    
                <i class="icon-publicar fab fa-youtube" style="color: #7FC15E; "><span style="margin-left: 5px;">Video</span></i>
                <i class="icon-publicar far fa-calendar-plus" style="color: #E7A33E; "><span style="margin-left: 5px;">Evento</span></i>
                <i class="icon-publicar far fa-file-alt" style="color: #F5987E; width: 155px;"><span style="margin-left: 5px;">Escribir articulo</span></i>
            </div>
            `;
            document.getElementById('opciones-Usuario').innerHTML = '';
            document.getElementById('opciones-Usuario').innerHTML =
            `
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="${usuarioActual.imgPerfil}" class="img-perfil" alt="Erro">
                    <br> <span style="font-size: 12px;">Yo</span>
                </a>
                <ul class="dropdown-menu" style="width: 300px; left: -250px;" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <div class="row container" style="margin-top: 5px;">
                        <div class="col-4" style="padding-right: 0;padding-left: 0px;height: 52px;width: 53px;">
                            <img src="${usuarioActual.imgPerfil}" class="img-crear-publicacion" alt="error" style="width: 70px; height: 70px;">
                        </div>
                        <div class="col-8 container" style="width: 172px;     padding-right: 0px;">
                            <span style="font-size: 15px; font-weight: bold; margin-left: 10px;;">${usuarioActual.nombre} ${usuarioActual.apellidos}</span><br>
                            <span style="font-size: 17px; font-weight: normal; position: relative;">Estudiante en ${usuarioActual.institucionEducativa}</span><br>
                        </div>
                        <input type="button" class="form-control" id="btn-ver-perfil" value="Ver perfil">
                        
                </li>
                <hr>
                <li>
                    <span style="font-weight: bolder; font-size: 18px; margin-left: 12px;">Cuenta</span>
                    <a class="dropdown-item subrayar" href="#">Configuracion</a>
                    <a class="dropdown-item subrayar" href="#">Ayuda</a>
                    <a class="dropdown-item subrayar" href="#">Idioma</a>
                </li>
                <hr>
                <li>
                    <a class="dropdown-item subrayar" href="logout.php">cerrar sesión</a>
                </li>
                </ul>
            `;

        }).catch(error=>{
            console.error(error);
        });
        
    }
    cargarUsuarioActual();

    function desplegarComentarios(id){
        document.getElementById('comentar-'+id).style.display = 'block';
    }

    function cargarPublicaciones(idUsuarioActual){
            axios({
            url:'../backend/api/publicaciones.php?idUsuario='+ idUsuarioActual,
            method: 'get',
            responseType: 'json'
        }).then(res=>{
            let publicacion = res.data;
            console.log('Publicaciones para el usuario',publicacion);
            document.getElementById('publicacion').innerHTML='';
            for (let i = 0; i < publicacion.length; i++) {
                let comentarios='';
                for (let j = 0; j < publicacion[i].comentarios.length; j++) {
                    comentarios +=
                    `
                    <div class="row container-fluid" style="margin-top: 5px;">
                        <div class="col-2" style="padding-right: 0;padding-left: 0px;height: 52px;width: 53px;">
                            <img src="${publicacion[i].comentarios[j].imgUsuario}" class="img-crear-publicacion" alt="error" style="float: right; width: 43px;height: 43px; margin-bottom: 10px;">
                        </div>
                        <div class="col-10" style="margin-bottom: 10px;">
                            <span style="font-size: 14px;">${publicacion[i].comentarios[j].usuario}</span><br>
                            <span style="font-size: 13px; color: #B1B0B1;">${publicacion[i].institucionEducativa}</span><br>
                            <p style="margin-top: 10px; width: 450px; font-size: 13px; text-align: justify;">${publicacion[i].comentarios[j].comentario}</p>
                                <span class="recomendar">Recomendar   </span>|<span class="recomendar">   Responder</span>
                        </div>
                    </div>
                    `;  
                }

            document.getElementById('publicacion').innerHTML+=
            `
            <div class="publicacion" >
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-2" style="width: auto; padding-right: 0;">
                                                    <img src="${publicacion[i].imagenPerfilUsuario}" alt="Error" class="img-publicacion">
                                                </div>
                                                <div class="col-10" style="height: 50px; width: 477px">
                                                    <span class="subrayar">${publicacion[i].nombre} ${publicacion[i].apellidos}</span><i class="fas fa-ellipsis-h" style="float: right; font-size: 22px; cursor: pointer;"></i>
                                                    <p class="card-text"><small class="text-muted">1 semana<i class="fas fa-globe-americas" style="margin-left: 10px;"></i></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <p class="card-text" style="margin-top: 10px; text-align: justify;">${publicacion[i].contenidoPost}</p>
                                </div>
                                <img src="${publicacion[i].imagen}" class="card-img-bottom" alt="Error">
                                <div style="font-size: 11px; color:#777777">
                                    <i class="fas fa-thumbs-up" style="margin-left: 15px; padding-top: 10px; margin-right: 5px; color: #1381B9;"><span style="color: black; margin-left: 7px;">${publicacion[i].cantidadLikes}</span></i>    
                                    <span style="margin-left: 15px;" class="subrayar" >${publicacion[i].comentarios.length}  comentarios</span>
                                </div>
                                <hr>
                                <div>
                                    
                                    <i class="icon-publicacion far fa-thumbs-up" style="margin-left: 7px;"><span style="margin-left: 5px;">Recomendar</span></i>    
                                    <i class="icon-publicacion fas fa-comment-dots"><span style="margin-left: 5px;">Comentar</span></i>
                                    <i class="icon-publicacion fas fa-share"><span style="margin-left: 5px;">Compartir</span></i>
                                    <i class="icon-publicacion fas fa-paper-plane" onclick="comentarPublicacion(${publicacion[i].comentarios.length},'${usuarioActual.nombre} ${usuarioActual.apellidos}',${publicacion[i].codigoPost})"><span style="margin-left: 5px;">Enviar</span></i>
                                </div>

                                <div style="display: bloke;" id="comentar-${publicacion[i].codigoPost}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row container">
                                                <div class="col-2" style="padding-right: 0;padding-left: 0px;height: 52px;width: 53px;">
                                                    <img src="${usuarioActual.imgPerfil}" class="img-crear-publicacion" alt="errr" style="float: right; width: 43px;height: 43px; margin-bottom: 10px;">
                                                </div>
                                                <div class="col-10" >
                                                    <input type="text" class="form-control txt-comentario" placeholder="Añadir un comentario" id="txt-comentario-${publicacion[i].codigoPost}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" >
                                        <div class="col-12">
                                            <span style="padding-left: 10px; margin-top: 5px; font-size: 14px; cursor: pointer;" >mas relevantes<i class="fas fa-caret-down" style="margin-left: 3px;"></i></span>
                                            <div id="comentario">
                                            ${comentarios}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
            `;
            
            }
        }).catch(error=>{
            console.error(error);
        });
        
    } 
    function comentarPublicacion(codigoComentario,usuario, codigoPost){
        console.log(codigoComentario, codigoPost, usuario)
        axios({
            url:'../backend/api/publicaciones.php',
            method: 'post',
            responseType: 'json',
            data:{
                codigoComentario:codigoComentario,
                codigoPost:codigoPost,
                usuario: usuario,
                imgUsuario:usuarioActual.imgPerfil,
                comentario:document.getElementById('txt-comentario-'+codigoPost).value
            }
        }).then(res=>{
            console.log(res);
        }).catch(error=>{
            
            console.error(error);
        });
        document.getElementById('txt-comentario-'+codigoPost).value = null;
        cargarPublicaciones(idUsuarioActual);
    }
