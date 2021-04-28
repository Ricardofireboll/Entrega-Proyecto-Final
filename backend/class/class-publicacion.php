<?php

    class Publicacion{
        private $codigoPost;
        private $codigoUsuario;
        private $imgPerfil;
        private $contenidoPost;
        private $imagen;
        private $cantidadLikes;
        private $comentarios;
        
        public function __construct(
            $codigoPost,
            $codigoUsuario,
            $imgPerfil,
            $contenidoPost,
            $imagen,
            $cantidadLikes,
            $comentarios
        ){
            $this->codigoPost = $codigoPost;
            $this->codigoUsuario = $codigoUsuario;
            $this->imgPerfil = $imgPerfil;
            $this->contenidoPost = $contenidoPost;
            $this->imagen = $imagen;
            $this->cantidadLikes = $cantidadLikes;
            $this->comentarios = $comentarios;
        }
    
        // metodos

        public static function  obtenerPosts($idUsuario){
            $contenidoArchivoUsuarios = file_get_contents('../data/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios,true);
            $usuario = null;
            for ($i=0; $i <sizeof($usuarios) ; $i++) { 
                if ($usuarios[$i]["codigoUsuario"] == $idUsuario){
                    $usuario = $usuarios[$i];
                    break;
                }
            }

            
            $contenidoArchivoPublicaciones = file_get_contents('../data/publicaciones.json');
            $publicaciones = json_decode($contenidoArchivoPublicaciones,true);
            $resultadoPublicaciones = array();
            for ($i=0; $i <sizeof($publicaciones) ; $i++) { 
                if(in_array($publicaciones[$i]["codigoUsuario"], $usuario["siguiendo"])){
                    
                    
                    for ($j=0; $j <sizeof($usuarios) ; $j++) { 
                        if ($publicaciones[$i]["codigoUsuario"] == $usuarios[$j]["codigoUsuario"]) {
                            $publicaciones[$i]["nombre"] = $usuarios[$j]["nombre"];
                            $publicaciones[$i]["imagenPerfilUsuario"] =$usuarios[$j]["imgPerfil"];
                            $publicaciones[$i]["institucionEducativa"] =$usuarios[$j]["institucionEducativa"];
                            $publicaciones[$i]["apellidos"] =$usuarios[$j]["apellidos"];
                        }
                    }
    
                    $resultadoPublicaciones[] = $publicaciones[$i];
                }
            }
            echo json_encode($resultadoPublicaciones);
        }

        public function guardarPublicacion(){
            $contenidoArchivoPublicaciones = file_get_contents('../data/publicaciones.json');
        $publicaciones = json_decode($contenidoArchivoPublicaciones,true);
        //Estamos agregando un nuevo arreglo asociativo al conjunto de post
        $publicaciones[] = array(
            "codigoPost" => $this-> codigoPost,
            "codigoUsuario" => $this-> codigoUsuario,
            "imgPerfil" => $this-> imgPerfil,
            "contenidoPost" => $this-> contenidoPost,
            "imagen" => $this-> imagen,
            "cantidadLikes" => $this-> cantidadLikes,
            "comentarios" => $this-> comentarios
        );
        //Sustituimos todo el contenido del archivo por este nuevo arreglo asociativo
        $archivo = fopen('../data/publicaciones.json','w');
        fwrite($archivo,json_encode($publicaciones));
        fclose($archivo);

        echo '{"CodigoResultado":1, "mensaje":"Publicacion guardada con exito"}';
        }


        public static function guardarComentario($codigoComentario,$codigoPost,$usuario,$imgUsuario,$comentario
        ){
            $contenidoArchivoPublicaciones = file_get_contents('../data/publicaciones.json');
            $publicaciones = json_decode($contenidoArchivoPublicaciones, true);
            
            for($i=0; $i<sizeof($publicaciones); $i++){
                if($publicaciones[$i]["codigoPost"] == $codigoPost){
                            $publicaciones[$i]["comentarios"][] = array(
                                "codigoComentario"=> $codigoComentario,
                                "codigoPost"=> $codigoPost,
                                "usuario"=> $usuario,
                                "imgUsuario"=> $imgUsuario,
                                "comentario"=> $comentario
                            );
                            $archivo = fopen('../data/publicaciones.json', 'w');
                            fwrite($archivo, json_encode($publicaciones));
                            fclose($archivo);
                            echo '{"CodigoResultado":1, "mensaje":"Comentario guardado con exito"}';
                }
            
            }            
        }
    



        /**
         * Get the value of codigoPost
         */ 
        public function getCodigoPost()
        {
                return $this->codigoPost;
        }

        /**
         * Set the value of codigoPost
         *
         * @return  self
         */ 
        public function setCodigoPost($codigoPost)
        {
                $this->codigoPost = $codigoPost;

                return $this;
        }

        /**
         * Get the value of codigoUsuario
         */ 
        public function getCodigoUsuario()
        {
                return $this->codigoUsuario;
        }

        /**
         * Set the value of codigoUsuario
         *
         * @return  self
         */ 
        public function setCodigoUsuario($codigoUsuario)
        {
                $this->codigoUsuario = $codigoUsuario;

                return $this;
        }

        /**
         * Get the value of imgPerfil
         */ 
        public function getImgPerfil()
        {
                return $this->imgPerfil;
        }

        /**
         * Set the value of imgPerfil
         *
         * @return  self
         */ 
        public function setImgPerfil($imgPerfil)
        {
                $this->imgPerfil = $imgPerfil;

                return $this;
        }

        /**
         * Get the value of contenidoPost
         */ 
        public function getContenidoPost()
        {
                return $this->contenidoPost;
        }

        /**
         * Set the value of contenidoPost
         *
         * @return  self
         */ 
        public function setContenidoPost($contenidoPost)
        {
                $this->contenidoPost = $contenidoPost;

                return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen()
        {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of cantidadLikes
         */ 
        public function getCantidadLikes()
        {
                return $this->cantidadLikes;
        }

        /**
         * Set the value of cantidadLikes
         *
         * @return  self
         */ 
        public function setCantidadLikes($cantidadLikes)
        {
                $this->cantidadLikes = $cantidadLikes;

                return $this;
        }

        /**
         * Get the value of comentarios
         */ 
        public function getComentarios()
        {
                return $this->comentarios;
        }

        /**
         * Set the value of comentarios
         *
         * @return  self
         */ 
        public function setComentarios($comentarios)
        {
                $this->comentarios = $comentarios;

                return $this;
        }
    }


?>