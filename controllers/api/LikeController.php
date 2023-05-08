<?php
class LikeController extends BaseController {
  /**
  * "/user/list" Endpoint - Get list of beers
  */

  public function getAction() {
    $strErrorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $arrQueryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $beerModel = new BeerModel();
        $intLimit = 750;
        $strOrderField = 'id';
        $strOrderDirection = 'a';

        if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
          $intId = $arrQueryStringParams['id'];
          $arrBeers = $beerModel->getOneBeer($intId);
          $responseData = json_encode($arrBeers);
          $this->sendOutput(
            $responseData,
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
          );
          return;
        }

        if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
          $intLimit = $arrQueryStringParams['limit'];
        }

        if (isset($arrQueryStringParams['order']) && $arrQueryStringParams['order']) {
          $strOrder = $arrQueryStringParams['order'];
          	
          $strOrderField = substr_replace($strOrder ,"", -1);
          $strOrderDirection = substr($strOrder, -1);
        }

        $arrBeers = $beerModel->getBeers($intLimit, [$strOrderField, $strOrderDirection]);
        $responseData = json_encode($arrBeers);
      } catch (Error $e) {
        $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $strErrorDesc = 'Method not supported';
      $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    // send output
    if (!$strErrorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(
        json_encode(array('error' => $strErrorDesc)),
        array('Content-Type: application/json', $strErrorHeader)
      );
    }
  }

  public function likeAction() {
    $strErrorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $responseData = '';

    if (strtoupper($requestMethod) == 'POST') {
      try {
        $likeModel = new LikeModel();

        if (isset($_POST['id']) && $_POST['id'] &&
            isset($_POST['ip']) && $_POST['ip']) 
        {
          $intId = $_POST['id'];
          $strIp = $_POST['ip'];

          $likeList = $likeModel->getIp($strIp);

          foreach ($likeList as $like) {
            if ($like['ip'] == $strIp && $like['id_bier'] == $intId) {
              $strErrorDesc = 'You already liked this beer!';
              $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
              $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
              );
              return;
            }
          }

          $beerModel = new BeerModel();
          $beerModel->updateBeer($intId, 'like_count', $beerModel->getOneBeer($intId)['like_count'] + 1);
          $responseData = $likeModel->createLike($intId, $strIp);
        }
      } catch (Error $e) {
        $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $strErrorDesc = 'Method not supported';
      $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    // send output
    if (!$strErrorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(
        json_encode(array('error' => $strErrorDesc)),
        array('Content-Type: application/json', $strErrorHeader)
      );
    }
  }
}
?>