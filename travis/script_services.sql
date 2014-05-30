INSERT INTO `services_endpoint` (`eid`, `name`, `server`, `path`, `authentication`, `server_settings`, `resources`, `debug`)
VALUES (1, 'rest', 'rest_server', 'rest', 'a:1:{s:8:"services";s:8:"services";}', 'a:2:{s:10:"formatters";a:5:{s:4:"json";b:1;s:7:"bencode";b:0;s:5:"jsonp";b:0;s:3:"php";b:0;s:3:"xml";b:0;}s:7:"parsers";a:6:{s:16:"application/json";b:1;s:30:"application/vnd.php.serialized";b:0;s:33:"application/x-www-form-urlencoded";b:0;s:15:"application/xml";b:0;s:19:"multipart/form-data";b:0;s:8:"text/xml";b:0;}}', 'a:12:{s:4:"cart";a:1:{s:10:"operations";a:2:{s:5:"index";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}}}s:7:"comment";a:2:{s:10:"operations";a:5:{s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:7:"actions";a:2:{s:8:"countAll";a:1:{s:7:"enabled";s:1:"1";}s:8:"countNew";a:1:{s:7:"enabled";s:1:"1";}}}s:4:"file";a:2:{s:10:"operations";a:4:{s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:7:"actions";a:1:{s:10:"create_raw";a:1:{s:7:"enabled";s:1:"1";}}}s:9:"line-item";a:1:{s:10:"operations";a:5:{s:5:"index";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}}}s:4:"node";a:3:{s:10:"operations";a:5:{s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:13:"relationships";a:2:{s:5:"files";a:1:{s:7:"enabled";s:1:"1";}s:8:"comments";a:1:{s:7:"enabled";s:1:"1";}}s:16:"targeted_actions";a:1:{s:11:"attach_file";a:1:{s:7:"enabled";s:1:"1";}}}s:5:"order";a:2:{s:10:"operations";a:4:{s:5:"index";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}}s:13:"relationships";a:1:{s:10:"line-items";a:1:{s:7:"enabled";s:1:"1";}}}s:7:"product";a:1:{s:10:"operations";a:5:{s:5:"index";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}}}s:15:"product-display";a:1:{s:10:"operations";a:2:{s:5:"index";a:1:{s:7:"enabled";s:1:"1";}s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}}}s:6:"system";a:1:{s:7:"actions";a:4:{s:7:"connect";a:1:{s:7:"enabled";s:1:"1";}s:12:"get_variable";a:1:{s:7:"enabled";s:1:"1";}s:12:"set_variable";a:1:{s:7:"enabled";s:1:"1";}s:12:"del_variable";a:1:{s:7:"enabled";s:1:"1";}}}s:13:"taxonomy_term";a:2:{s:10:"operations";a:5:{s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:7:"actions";a:1:{s:11:"selectNodes";a:1:{s:7:"enabled";s:1:"1";}}}s:19:"taxonomy_vocabulary";a:2:{s:10:"operations";a:5:{s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:7:"actions";a:1:{s:7:"getTree";a:1:{s:7:"enabled";s:1:"1";}}}s:4:"user";a:3:{s:10:"operations";a:5:{s:8:"retrieve";a:1:{s:7:"enabled";s:1:"1";}s:6:"create";a:1:{s:7:"enabled";s:1:"1";}s:6:"update";a:1:{s:7:"enabled";s:1:"1";}s:6:"delete";a:1:{s:7:"enabled";s:1:"1";}s:5:"index";a:1:{s:7:"enabled";s:1:"1";}}s:7:"actions";a:4:{s:5:"login";a:2:{s:7:"enabled";s:1:"1";s:8:"settings";a:1:{s:8:"services";a:1:{s:20:"resource_api_version";s:3:"1.0";}}}s:6:"logout";a:2:{s:7:"enabled";s:1:"1";s:8:"settings";a:1:{s:8:"services";a:1:{s:20:"resource_api_version";s:3:"1.0";}}}s:5:"token";a:1:{s:7:"enabled";s:1:"1";}s:8:"register";a:1:{s:7:"enabled";s:1:"1";}}s:16:"targeted_actions";a:3:{s:6:"cancel";a:1:{s:7:"enabled";s:1:"1";}s:14:"password_reset";a:1:{s:7:"enabled";s:1:"1";}s:20:"resend_welcome_email";a:1:{s:7:"enabled";s:1:"1";}}}}', 0);
