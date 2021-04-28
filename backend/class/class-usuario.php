<?php
    class Usuario{
        private $codigoUsuario;
        private $nombre;
        private $apellidos;
        private $email;
        private $imgPerfil;
        private $imgFondo;
        private $password;
        private $pais;
        private $ciudad;
        private $institucionEducativa;
        private $titulo;
        private $especializacion;
        private $añoInicio;
        private $añofinalizacion;
        private $siguiendo;

         // Constructor
        public function __construct(
            $codigoUsuario,
            $nombre,
            $apellidos,
            $email,
            $imgPerfil,
            $imgFondo,
            $password,
            $pais,
            $ciudad,
            $institucionEducativa,
            $titulo,
            $especializacion,
            $añoInicio,
            $añofinalizacion,
            $siguiendo
        ){
            $this->codigoUsuario = $codigoUsuario;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->imgPerfil = $imgPerfil;
            $this->imgFondo = $imgFondo;
            $this->password = $password;
            $this->pais = $pais;
            $this->ciudad = $ciudad;
            $this->institucionEducativa = $institucionEducativa;
            $this->titulo = $titulo;
            $this->especializacion = $especializacion;
            $this->añoInicio = $añoInicio;
            $this->añofinalizacion = $añofinalizacion;
            $this->siguiendo = $siguiendo;
        }
        // Metodos
        public static function verificarUsuario($email, $password){
            $contenidoArchivoUsuarios = file_get_contents('../data/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);
            for ($i=0; $i <sizeof($usuarios); $i++) { 
                if ($usuarios[$i]["email"] == $email && $usuarios[$i]["password"] == $password) {
                    return $usuarios[$i];
                }
            }
            return null;
        }

        public static function obtenerUsuarioVerificado($email,$password){

            $contenidoArchivoUsuarios = file_get_contents('../data/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);
            $usuario = null;
            for ($i=0; $i <sizeof($usuarios); $i++) { 
                if ($usuarios[$i]["email"] == $email && $usuarios[$i]["password"] == $password) {
                    $usuario = $usuarios[$i];
                }
            }
            echo json_encode($usuario);
        }

        public static function obtenerUsuarios(){
            $contenidoArchivo = file_get_contents('../data/usuarios.json');
            echo $contenidoArchivo;
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
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellidos
         */ 
        public function getApellidos()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getemail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setemail($email)
        {
                $this->email = $email;

                return $this;
        }

        
            /**
             * Get the value of password
             */ 
            public function getpassword()
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setpassword($password)
            {
                        $this->password = $password;

                        return $this;
            }

        /**
         * Get the value of pais
         */ 
        public function getPais()
        {
                return $this->pais;
        }

        /**
         * Set the value of pais
         *
         * @return  self
         */ 
        public function setPais($pais)
        {
                $this->pais = $pais;

                return $this;
        }

        /**
         * Get the value of ciudad
         */ 
        public function getCiudad()
        {
                return $this->ciudad;
        }

        /**
         * Set the value of ciudad
         *
         * @return  self
         */ 
        public function setCiudad($ciudad)
        {
                $this->ciudad = $ciudad;

                return $this;
        }

        /**
         * Get the value of institucionEducativa
         */ 
        public function getInstitucionEducativa()
        {
                return $this->institucionEducativa;
        }

        /**
         * Set the value of institucionEducativa
         *
         * @return  self
         */ 
        public function setInstitucionEducativa($institucionEducativa)
        {
                $this->institucionEducativa = $institucionEducativa;

                return $this;
        }

        /**
         * Get the value of titulo
         */ 
        public function getTitulo()
        {
                return $this->titulo;
        }

        /**
         * Set the value of titulo
         *
         * @return  self
         */ 
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;

                return $this;
        }

        /**
         * Get the value of especializacion
         */ 
        public function getEspecializacion()
        {
                return $this->especializacion;
        }

        /**
         * Set the value of especializacion
         *
         * @return  self
         */ 
        public function setEspecializacion($especializacion)
        {
                $this->especializacion = $especializacion;

                return $this;
        }

        /**
         * Get the value of añoInicio
         */ 
        public function getAñoInicio()
        {
                return $this->añoInicio;
        }

        /**
         * Set the value of añoInicio
         *
         * @return  self
         */ 
        public function setAñoInicio($añoInicio)
        {
                $this->añoInicio = $añoInicio;

                return $this;
        }

        /**
         * Get the value of añofinalizacion
         */ 
        public function getAñofinalizacion()
        {
                return $this->añofinalizacion;
        }

        /**
         * Set the value of añofinalizacion
         *
         * @return  self
         */ 
        public function setAñofinalizacion($añofinalizacion)
        {
                $this->añofinalizacion = $añofinalizacion;

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
         * Get the value of imgFondo
         */ 
        public function getImgFondo()
        {
                return $this->imgFondo;
        }

        /**
         * Set the value of imgFondo
         *
         * @return  self
         */ 
        public function setImgFondo($imgFondo)
        {
                $this->imgFondo = $imgFondo;

                return $this;
        }


        /**
         * Get the value of siguiendo
         */ 
        public function getSiguiendo()
        {
                return $this->siguiendo;
        }

        /**
         * Set the value of siguiendo
         *
         * @return  self
         */ 
        public function setSiguiendo($siguiendo)
        {
                $this->siguiendo = $siguiendo;

                return $this;
        }
    }
?>