
<?php
require_once 'Controller.php';
require_once '../Entities/Category.php';
require_once '../Models/CategoryModel.php';


class CategoryController extends Controller
{
    public function displayCategoryAction()//Afficher les catégories/Liée à la vue(NULL)
    {
        $categoryModel = new CategoryModel();
        // Récupérer toutes les catégories
        $categories = $categoryModel->listeCategory();  
        
        // Récupérer le message si présent dans l'URL
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        
        // Afficher la vue en passant les catégories et le message
        $this->render('concert/displayEvent', ['categories' => $categories, 'message' => $message]);
    }
    
    
}
