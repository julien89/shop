<?php 
	namespace Wshop;
	use GuzzleHttp;

	class WshopApi
	{
		protected $url = 'http://www.wshop.fr/api';
		protected $type = false;
		protected $client = null;
		protected $response = false;

		public function __construct() {
			$this->client = new GuzzleHttp\Client();
		}

        /**
        * Set le type de donnée que l'on veut (Produit, Rayon)
        * @param [type] $type Type de données
        * @author <[<julien.jesudasan@gmail.com>]>
        */
		public function setType($type) {
			$this->type = $type;
		}

        /**
         * [sendRequest description]
         * @param  string $action [description]
         * @param  array  $params [description]
         * @return [type]         [description]
         */
		public function sendRequest(string $action, array $params) {
            
            $queryParams = (!empty($params)) ? $this->createQueryParams($params) : '';
            $request_url = $this->url.'/'.$this->type.'/'.$action.$queryParams;
			$response = $this->client->request('GET', $request_url );
            $this->setResponse($response->getBody()->getContents());
		}

        /**
         * [getResponse description]
         * @return [type] [description]
         */
		public function getResponse() {
            return $this->response;
		}

        /**
         * [setResponse description]
         * @param string $response [description]
         */
		private function setResponse( string $response) {
			$this->response = $response;
		}

        /**
         * [createQueryParams description]
         * @param  array  $params [description]
         * @return [type]         [description]
         */
        private function createQueryParams(array $params) : string {

            $queryParams = '';
            $tmpArray = array_keys($params);
            $firstElement = array_shift($tmpArray);
          
            foreach($params as $key => $param) {
                
                $type = ($key == $firstElement) ? '?' : '&';
                
                $queryParams .= $type.$key.'='.$param;
            }

            return $queryParams;
        }

	}