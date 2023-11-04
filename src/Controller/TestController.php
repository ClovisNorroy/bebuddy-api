<?

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class TestController extends AbstractController
{
  public function test(): Response
  {
    return new Response('Tout fonctionne');
  }
}