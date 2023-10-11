<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* base.html */
class __TwigTemplate_baf74128214fa358d7e50ea603cc354a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'title' => [$this, 'block_title'],
            'nav' => [$this, 'block_nav'],
            'content' => [$this, 'block_content'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>
     ";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 12
        echo "</head>

<body>

     <header class=\"p-3 mb-3 border-bottom\">
          <div class=\"container\">
               ";
        // line 18
        $this->displayBlock('nav', $context, $blocks);
        // line 21
        echo "          </div>
     </header>

     <main class=\"container py-3\">
          ";
        // line 25
        $this->displayBlock('content', $context, $blocks);
        // line 26
        echo "     </main>

     <div class=\"container-fluid p-0\">
          <footer class=\"border-top py-3 my-4\">
               <div class=\"container d-flex flex-wrap justify-content-between align-items-center\">
                    <div class=\"col-md-4 d-flex align-items-center\">
                         <a href=\"/\" class=\"mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1\">
                              <svg class=\"bi\" width=\"30\" height=\"24\">
                                   <use xlink:href=\"#bootstrap\" />
                              </svg>
                         </a>
                         <span class=\"mb-3 mb-md-0 text-muted\">&copy; 2023 COPELAND</span>
                    </div>

                    <ul class=\"nav col-md-4 justify-content-end list-unstyled d-flex\">
                         <li class=\"ms-3\"><a class=\"text-muted\" href=\"https://github.com/kmtrebacz/copeland\" target=\"_blank\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-github\" viewBox=\"0 0 16 16\">
                              <path d=\"M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z\"/>
                         </svg></a></li>
                    </ul>
               </div>
          </footer>
     </div>

     <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz\" crossorigin=\"anonymous\"></script>
     ";
        // line 50
        $this->displayBlock('scripts', $context, $blocks);
        // line 51
        echo "</body>

</html>";
    }

    // line 5
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "     <meta charset=\"UTF-8\">
     <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
     <title>";
        // line 8
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
     <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM\" crossorigin=\"anonymous\">
     <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css\">
     ";
    }

    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 18
    public function block_nav($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 19
        echo "
               ";
    }

    // line 25
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 50
    public function block_scripts($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  138 => 50,  132 => 25,  127 => 19,  123 => 18,  110 => 8,  106 => 6,  102 => 5,  96 => 51,  94 => 50,  68 => 26,  66 => 25,  60 => 21,  58 => 18,  50 => 12,  48 => 5,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.html", "C:\\xampp\\htdocs\\copeland\\templates\\base.html");
    }
}
