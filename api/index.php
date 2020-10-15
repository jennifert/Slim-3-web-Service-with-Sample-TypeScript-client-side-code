<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

header("Content-Type: application/json; charset=UTF-8");

require '../vendor/autoload.php';


$config['displayErrorDetails'] = true; //dev mode
$config['addContentLengthHeader'] = false; //make slim behave predictably

$app = new \Slim\App(["settings" => $config]);

$app->get('/', function (Request $request, Response $response) {
    echo 'Jenn Tesolin.com API 0.0.1';
});

function parseYAMLFrontMatter($search_for){
    $parser = new Mni\FrontYAML\Parser(); //create yaml parser
    $dir = "/Users/jenn/Sites/jenntesolin.com/_posts/*"; //directory to search in
    $count = 0;
    $json_search_results = '';
    $json_all_results = '';
    $results = '';

    // Open a known directory, and proceed to read its contents
	foreach(glob($dir) as $filename) {
        $yaml_str = file_get_contents($filename);
        $document = $parser->parse($yaml_str, false); //pass in search term. If you want markdown parsed remove, true
        $yaml = $document->getYAML(); //get all YAML front matter
         // $html = $document->getContent(); //hidden, we do not want post content
        // print_r($yaml);
        $title = $yaml['title'];
        $date = $yaml['date'];
        $categories = json_encode($yaml['categories']);
        $tags = json_encode($yaml['tags']);
        $summary = $yaml['summary'];

        if ($search_for <> ''){
            if(strpos($yaml_str, $search_for)){
                $json_search_results .= '{"title": "'.$title.'","date": "'.$date.'","summary": "'.$summary.'","categories": '.$categories.',"tags": '.$tags.'},';
                $count++;
            }
        } else {
            $json_all_results .= '{"title": "'.$title.'","date": "'.$date.'","summary": "'.$summary.'","categories": '.$categories.',"tags": '.$tags.'},';;
        }

        
    } //end for each
    
    if ($search_for <> ''){
        $result = '{
            "status": "ok",
            "posts":[
                '.rtrim($json_search_results,',').'
            ],
            "howmany":'.$count.',
            "type":"search"
        }';
    } else {
        $result = '{
            "posts":[
            "status": "ok",
                '.rtrim($json_all_results,',').'
            ],
            "type":"all"
        }';
    }

    return $result;

} //end function

$app->post('/search/{name}', function (Request $request, Response $response, array $args) {
    $term = $args['name'];
    $search = trim(filter_var($term, FILTER_SANITIZE_STRING)); //make sure text will not break anything
   echo parseYAMLFrontMatter($search);
});

$app->post('/posts/all', function (Request $request, Response $response) {
    // $data = $request->getParsedBody(); //get post body
    echo parseYAMLFrontMatter('');
});

$app->run();