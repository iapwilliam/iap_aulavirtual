<?php
require_once __DIR__ .'/../vendor/autoload.php';
class Google
{
    private $DirID = "";
    private $archivo = "";
    private $archivoNombre = "";
    private $googleService = ""; 
    private $archivoID = "";
    public function __construct($DirID)
    {
        $this->googleService = DOC_ROOT . "/google-service.json"; 
        $this->DirID = $DirID;
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $this->googleService);
    }

    function setArchivo($data): void
    {
        $this->archivo = $data;
    }

    function setArchivoNombre($data): void
    {
        $this->archivoNombre = $data;
    }

    function setArchivoID($data) : void {
        $this->archivoID = $data;
    }

    function subirArchivo()
    {
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(["https://www.googleapis.com/auth/drive.file"]);
        try {
            //instanciamos el servicio
            $service = new Google_Service_Drive($client);

            //instacia de archivo
            $file = new Google_Service_Drive_DriveFile();
            $file->setName($this->archivoNombre);

            //obtenemos el mime type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $this->archivo);

            //id de la carpeta donde hemos dado el permiso a la cuenta de servicio 
            $file->setParents(array($this->DirID));
            // // $file->setDescription($descripcion);
            $file->setMimeType($mime_type);

            $result = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($this->archivo),
                    'mimeType' => $mime_type,
                    'uploadType' => 'media',
                )
            );
            return $result;
        } catch (Google_Service_Exception $gs) {
            $m = json_decode($gs->getMessage());
            return $m->error->message;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } 
    
    function eliminarArchivo() {
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(["https://www.googleapis.com/auth/drive.file"]);
        try{
            $service = new Google_Service_Drive($client); 
            $result = $service->files->delete($this->archivoID);
            return $result;
        } catch (Google_Service_Exception $gs) {
            $m = json_decode($gs->getMessage());
            return $m->error->message;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
