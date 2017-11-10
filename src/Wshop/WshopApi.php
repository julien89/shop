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


		public function setType($type) {
			$this->type = $type;
		}

		public function sendRequest(string $action, array $params) {
            
            $queryParams = (!empty($params)) ? $this->createQueryParams($params) : '';
            $request_url = $this->url.'/'.$this->type.'/'.$action.$queryParams;
			$response = $this->client->request('GET', $request_url );
            $this->setResponse($response->getBody()->getContents());
		}

		public function getResponse() {
            return $this->response;
		}

		private function setResponse( string $response) {
			$this->response = $response;
		}

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