<?php

$feedbacks = array();


/* Use internal libxml errors -- turn on in production, off for debugging */
libxml_use_internal_errors(true);
/* Createa a new DomDocument object */
$dom = new DomDocument;
/* Load the HTML */
$dom->loadHTMLFile("https://www.freelancer.com/u/aamirmukaram.html");


//Getting feedbacks

/* Create a new XPath object */
$xpath = new DomXPath($dom);
/* Query all <td> nodes containing specified class name */
$nodes = $xpath->query('//*[@id="profile-reviews"]/ul/li/p');
/* Set HTTP response header to plain text for debugging output */
header("Content-type: text/plain");
/* Traverse the DOMNodeList object to output each DomNode's nodeValue */
foreach ($nodes as $i => $node) {
    $obj = new stdClass();
    $obj->feedback = $node->nodeValue;
    array_push($feedbacks,$obj);
}


//Getting feedback owner

$nodes = $xpath->query('//*[@id="profile-reviews"]/ul/li/span[3]/span[1]/span');
/* Set HTTP response header to plain text for debugging output */
header("Content-type: text/plain");
/* Traverse the DOMNodeList object to output each DomNode's nodeValue */
foreach ($nodes as $i => $node) {
    $feedbacks[$i]->owner = $node->nodeValue;
}

echo json_encode(array('success' => true, 'data' => $feedbacks, 'message' => 'Your data has been fetched'));


?>