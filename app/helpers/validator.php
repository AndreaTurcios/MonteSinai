<?php
/*
*	Clase para validar todos los datos de entrada del lado del servidor.
*   Es clase padre de los modelos porque los datos se validan en los métodos setter.
*/
class Validator
{
    // Propiedades para manejar algunas validaciones.
    private $passwordError = null;
    private $imageError = null;
    private $fileName = null;
    private $fileError = null;
    private $imageName = null;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getFileError()
    {
        return $this->fileError;
    }

    

    /*
    *   Método para obtener el error al validar una contraseña.
    */
    public function getPasswordError()
    {
        return $this->passwordError;
    }

    /*
    *   Método para obtener el nombre del archivo de la imagen validada previamente.
    */
    public function getImageName()
    {
        return $this->imageName;
    }

    /*
    *   Método para obtener el error al validar una imagen.
    */
    public function getImageError()
    {
        return $this->imageError;
    }

    /*
    *   Método para sanear todos los campos de un formulario (quitar los espacios en blanco al principio y al final).
    *
    *   Parámetros: $fields (arreglo con los campos del formulario).
    *   
    *   Retorno: arreglo con los campos saneados del formulario.
    */
    public function validateForm($fields)
    {
        foreach ($fields as $index => $value) {
            $value = strip_tags(trim($value));
            $fields[$index] = $value;
        }
        return $fields;
    }

    public function validatePDFFile($file)
    {
        if($file) {
            if($file['size'] <= 2097152){
                if(mime_content_type($file['tmp_name']) == 'application/pdf'){
                    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    $this->fileName = uniqid() . '.' . $extension;
                    return true;
                } else {
                    $this->fileError = 'El archivo debe ser PDF';
                    return false;
                }
            } else {
                $this->fileError = 'El tamaño tiene que ser menor a 2MB';
                return false;
            }
        } else {
            $this->fileError = 'archivo no existe';
            return false;
        }
    }

    /*
    *   Método para validar un numero natural como por ejemplo llave primaria, llave foránea, entre otros.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateNaturalNumber($value)
    {
        // Se verifica que el valor sea un número entero mayor o igual a uno.
        if (filter_var($value, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un archivo de imagen.
    *
    *   Parámetros: $file (archivo de un formulario), $maxWidth (ancho máximo para la imagen) y $maxHeigth (alto máximo para la imagen).
    *   
    *   Retorno: booleano (true si el archivo es correcto o false en caso contrario).
    */
    public function validateImageFile($file, $maxWidth, $maxHeigth)
    {
        // Se verifica si el archivo existe, de lo contrario se establece un número de error.
        if ($file) {
            // Se comprueba si el archivo tiene un tamaño menor o igual a 2MB, de lo contrario se establece un número de error.
            if ($file['size'] <= 2097152) {
                // Se obtienen las dimensiones de la imagen y su tipo.
                list($width, $height, $type) = getimagesize($file['tmp_name']);
                // Se verifica si la imagen cumple con las dimensiones máximas, de lo contrario se establece un número de error.
                if ($width <= $maxWidth && $height <= $maxHeigth) {
                    // Se comprueba si el tipo de imagen es permitido (1 - GIF, 2 - JPG y 3 - PNG), de lo contrario se establece un número de error.
                    if ($type == 1 || $type == 2 || $type == 3) {
                        // Se obtiene la extensión del archivo.
                        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                        // Se establece un nombre único para el archivo.
                        $this->imageName = uniqid().'.'.$extension;
                        return true;
                    } else {
                        $this->imageError = 'El tipo de la imagen debe ser gif, jpg o png';
                        return false;
                    }
                } else {
                    $this->imageError = 'La dimensión de la imagen es incorrecta';
                    return false;
                }
             } else {
                $this->imageError = 'El tamaño de la imagen debe ser menor a 2MB';
                return false;
             }
        } else {
            $this->imageError = 'El archivo de la imagen no existe';
            return false;
        }
    }

    /*
    *   Método para validar un correo electrónico.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato booleano.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateBoolean($value)
    {
        if ($value == 1 || $value == 0 || $value == true || $value == false) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar una cadena de texto (letras, digitos, espacios en blanco y signos de puntuación).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateString($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.\:]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato alfabético (letras y espacios en blanco).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateAlphabetic($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePasswordd($value)
    {
        // Se verifica la longitud mínima de la contraseña.
        if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%&]{8,75}$/',$value)) {
            return true;           
        } else {
            $this->passwordError = 'Clave menor a 8 caracteres o no cumple con los requisitos de seguridad';
            return false;
        }
    }

    /*
    *   Método para validar un dato alfanumérico (letras, dígitos y espacios en blanco).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateAlphanumeric($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\-]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato monetario.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateMoney($value)
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar una contraseña.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validatePassword($value)
    {
        // Se verifica la longitud mínima de la contraseña.
        if (strlen($value) < 8) {
            $this->passwordError = 'Clave menor a 8 caracteres';
            return false;
        } else{
            if(strlen($value) > 16){
            $this->passwordError = "La clave no puede tener más de 16 caracteres";
            return false;
            } else{
                if (!preg_match('`[a-z]`',$value)){
                $this->passwordError = "La clave debe tener al menos una letra minúscula";
                return false;
                } else{
                    if (!preg_match('`[A-Z]`',$value)){
                    $this->passwordError = "La clave debe tener al menos una letra mayúscula";
                    return false;
                    } else{
                        if (!preg_match('`[0-9]`',$value)){
                        $this->passwordError = "La clave debe tener al menos un caracter numérico";
                        return false;
                        } else {
                            if ((strpos($value, " "))){
                                $this->passwordError = "Procure que la contraseña no tenga espacios";
                                return false;
                            } else{
                                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                                        return true;
                                }
                                
                            }
                        }
                    }
                }
            }
        }     
    }

    public function validatePasswordAlias($value, $alias)
    {
        similar_text($value, $alias, $percent);
        if($percent >= 30){
            $this->passwordError = "Por favor, no ocupe su nombre de usuario como contraseña";
            return false;
        } else{
            return true;
        }
        
    }

    /*
    *   Método para validar el formato del DUI (Documento Único de Identidad).
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateDUI($value)
    {
        // Se verifica que el número tenga el formato 00000000-0.
        if (preg_match('/^[0-9]{8}[-][0-9]{1}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateNIT($value)
    {
        
        // Se verifica que el número tenga el formato 00000000-0.
        if (preg_match('/^[0-9]{4}[-][0-9]{6}[-][0-9]{3}[-][0-9]{1}$/', $value)) {
            return true;
        } else {
            return false;

        }
    }

    /*
    *   Método para validar un número telefónico.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validatePhone($value)
    {
        // Se verifica que el número tenga el formato 0000-0000 y que inicie con 2, 6 o 7.
        if (preg_match('/^[2,6,7]{1}[0-9]{3}[-][0-9]{4}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar una fecha.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateDate($value)
    {
        // Se dividen las partes de la fecha y se guardan en un arreglo en el siguiene orden: año, mes y día.
        $date = explode('-', $value);
        if (checkdate($date[1], $date[2], $date[0])) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar la ubicación de un archivo antes de subirlo al servidor.
    *
    *   Parámetros: $file (archivo), $path (ruta del archivo) y $name (nombre del archivo).
    *   
    *   Retorno: booleano (true si el archivo fue subido al servidor o false en caso contrario).
    */
    public function saveFile($file, $path, $name)
    {
        // Se verifica que el archivo exista.
        if ($file) {
            // Se comprueba que la ruta en el servidor exista.
            if (file_exists($path)) {
                // Se verifica que el archivo sea movido al servidor.
                if (move_uploaded_file($file['tmp_name'], $path.$name)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
    *   Método para validar la ubicación de un archivo antes de borrarlo del servidor.
    *
    *   Parámetros: $path (ruta del archivo) y $name (nombre del archivo).
    *   
    *   Retorno: booleano (true si el archivo fue borrado del servidor o false en caso contrario).
    */
    public function deleteFile($path, $name)
    {
        // Se verifica que la ruta exista.
        if (file_exists($path)) {
            // Se comprueba que el archivo sea borrado del servidor.
            if (@unlink($path . $name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    


    

}
?>