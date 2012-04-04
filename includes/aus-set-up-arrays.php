<?php
/**
* Set Up Arrays
*
* Define various arrays
*
* @package	Artiss-URL-Shortener
* @since	1.7
*/

/**
* Build Services Array
*
* Function to build array of URL shortening services
*
* @since	1.0
*
* @return			string	Array of values
*/

function aus_build_services_array() {

    $service = array(       '1url.com' => 'http://1url.com/?api=1url&u=',
                            '2zeus' => 'http://2ze.us/generate/?url=',
                            '307.to' => 'http://a.307.to/api2/post?format=text&u=',
                            '307.to+key' => 'http://a.307.to/api2/post?format=text&key={key}&u=',
                            '3.ly' => 'http://3.ly/?api=em5893833&u=',
                            '9mp' => 'http://9mp.com/api/shrink.php?username={login}&key={key}&version=1.0&mode=live&url=',
                            'abbrr' => 'http://api.abbrr.com/api.php?out=link&url=',
                            'adf.ly' => 'http://adf.ly/bml.php?url=',
                            'adjix' => 'http://api.adjix.com/shrinkLink?partnerID={key}&url=',
                            'ad.vu' => 'http://api.adjix.com/shrinkLink?partnerID={key}&ultraShort=y&url=',
                            'a.gd' => 'http://a.gd/?module=ShortURL&file=Add&mode=API&url=',
                            'a.nf' => 'http://a.nf/?module=ShortURL&file=Add&mode=API&url=',
                            'arm.in' => '#http://arm.in/arminize/',
                            'bit.ly+key' => 'http://api.bit.ly/v3/shorten?login={login}&apiKey={key}&format=xml&longUrl=',
                            'budurl' => 'http://budurl.com/api/v1/budurls/shrink?api_key={key}&long_url=',
                            'buk.me' => 'http://buk.me/api.php?url=',
                            'chilp.it' => 'http://chilp.it/api.php?url=',
                            'clck.ru' => 'http://clck.ru/--?url=',
                            'cli.gs' => 'http://cli.gs/api/v1/cligs/create?url=',
                            'coge.la' => 'http://coge.la/api.php?url=',
                            'coge.la+key' => 'http://coge.la/api.php?user={login}&password={password}&url=',
                            'cort.as' => 'http://www.soitu.es/cortas/encode.pl?r=json&u=',
                            'cort.as+key' => 'http://www.soitu.es/cortas/encode.pl?r=json&k={key}&u=',
                            'durl.me' => 'http://durl.me/api/Create.do?type=json&longurl=',
                            'ez.com' => 'http://ez.com/api/v1/ezlinks/shrink?api_key={key}&long_url=',
                            'fa.by' => 'http://fa.by/?module=ShortURL&file=Add&mode=API&url=',
                            'fon.gs' => 'http://fon.gs/create.php?url=',
                            'fwd4.me' => 'http://api.fwd4.me/?url=',
                            'g1n.co' => 'http://g1n.co/create.php?url=',
                            'gl.am' => 'http://gl.am/API::shorten?type=plain&url=',
                            'goo.by' => 'http://goo.by/api/shorten?url=',
                            'gurl.es' => 'http://gurl.es/api.php?url=',
                            'hex.io' => 'http://hex.io/api-create.php?url=',
                            'hop.im' => 'http://hop.im/api.php?url=',
                            'href.in' => 'http://href.in/api.php?create=',
                            'hurl' => 'http://www.hurl.ws/api/url=',
                            'is.gd' => 'http://is.gd/api.php?longurl=',
                            'idek.net' => 'http://idek.net/shorten/?idek-api=true&idek-url=',
                            'ir.pe' => 'http://ir.pe/?api=1&url=',
                            'ito.mx' => 'http://ito.mx/?module=ShortURL&file=Add&mode=API&url=',
                            'ity.im' => 'http://ity.im/index-dev.php?url=',
                            'j.mp' => 'http://j.mp/api?url=',
                            'j.mp+key' => 'http://api.j.mp/shorten?version=2.0.1&login={login}&apiKey={key}&format=xml&longUrl=',
                            'kissa.be' => 'http://kissa.be/api/shortener/url?content=',
                            'kl.am' => 'http://kl.am/api/shorten/?format=text&url=',
                            'kore.us' => 'http://kore.us/api.php?type=plain&action=encode&url=',
                            'korta.nu' => 'http://korta.nu/api/api.php?url=',
                            'kots.nu' => 'http://kots.nu/api.php?apikey={key}&url=',
                            'krz.ch' => 'http://krz.ch/?module=ShortURL&file=Add&mode=API&url=',
                            'lincr' => 'http://lin.cr?mode=api&full=1&l=',
                            'linkbee' => '#http://linkbee.com/api.php?task=quicken&url=',
                            'linkbee+key' => '#http://linkbee.com/api.php?task=shorten&user={login}&pass={password}&url=',
                            'linkee' => 'http://api.linkee.com/1.0/shorten?format=text&input=',
                            'linxfix' => 'http://linxfix.com/enterlink.php?link=',
                            'liurl.cn' => 'http://liurl.cn/api-create.php?url=',
                            'lnk.by' => 'http://lnk.by/Shorten?format=json&url=',
                            'lnk.co' => 'http://lnk.co/api.php?task=quicken&url=',
                            'lnk.co+banner' => 'http://lnk.co/api.php?task=shortenu&user={login}&pass={password}&ad=1&url=',
                            'lnk.co+key' => 'http://lnk.co/api.php?task=shortenu&user={login}&pass={password}&ad=0&url=',
                            'ln-s.net' => 'http://ln-s.net/home/api.jsp?url=',
                            'ln-s.ru' => 'http://ln-s.ru/?nohtml&u=',
                            'lt.tl' => 'http://lt.tl/api.php?create=',
                            'lurl.no' => 'http://lurl.no/api/0.1/?url=',
                            'merky.de' => 'http://merky.de/api/?short=1&url=',
                            'micurl' => 'http://micurl.com/api.php?url=',
                            'migre.me' => 'http://migre.me/api.txt?url=',
                            'min2me' => 'http://min2.me/api_new.xml?url=',
                            'minify.us' => 'http://minify.us/api.php?u=',
                            'minilink' => 'http://minilink.org/?xml=1&url=',
                            'minurl' => 'http://www.minu.me/api.php?url=',
                            'nbx.ch' => 'http://nbx.ch/_exec/create.php?service=wordpress_plugin_da&uri=',
                            'ndurl' => 'http://www.ndurl.com/api.generate/?type=web&url=',
                            'pendek.in' => 'http://pendek.in/?url=',
                            'piko.me' => 'http://piko.me/?url_API=',
                            'piurl' => '#http://www.piurl.com/api.php?url=',
                            'p.ly' => 'http://p.ly/api/shorten?url=',
                            'puke.it' => 'http://puke.it/api.php?apikey={key}&url=',
                            'qlnk.net' => 'http://qlnk.net/api.php?url=',
                            'qr.cx' => 'http://qr.cx/api/?longurl=',
                            'qux.in' => 'http://qux.in/api/shorten?apiKey={key}&longUrl=',
                            'r.im' => 'http://r.im/api/index.cfm?long_url=',
                            'rde.me' => 'http://rde.me/index.php?rdeTask=api&longURL=',
                            'redir.ec' => 'http://redir.ec/_api/rest/redirec/create?url=',
                            'retwt.me' => 'http://api.retwt.me/shorten?longUrl=',
                            'ri.ms' => 'http://ri.ms/api-create.php?url=',
                            's4c' => 'http://s4c.in/api.php?username=apiconnect&password=nohash&action=shorturl&adtype=2&url=',
                            'safe.mn' => 'http://safe.mn/api/?url=',
                            'sai.ly' => 'http://www.sai.ly/new.txt?href=',
                            'short.ie' => 'http://short.ie/api?format=xml&url=',
                            'short.to' => 'http://short.to/s.txt?url=',
                            'shortn.me' => 'http://shortn.me/api.php?url=',
                            'shw.me' => 'http://shw.me/redirects/api?url=',
                            'sl.ly' => 'http://sl.ly/?module=ShortURL&file=Add&mode=API&url=',
                            'smsh.me' => 'http://smsh.me/?api=xml&url=',
                            'snkr.me' => 'http://snkr.me/api.php?url=',
                            'srnk.net' => 'http://srnk.net/create.php?url=',
                            'srs.li' => 'http://srs.li/api/create?plaintext&url=',
                            'su.pr' => 'http://su.pr/api?url=',
                            'su.pr+key' => 'http://su.pr/api/shorten?login={login}&apiKey={key}&longUrl=',
                            'timesurl' => 'http://timesurl.at/api/rest.php?url=',
                            'tinyarro.ws' => 'http://tinyarro.ws/api-create.php?url=',
                            'tinyurl' => 'http://tinyurl.com/api-create.php?url=',
                            'togoto.us' => 'http://togoto.us/api.php?u=',
                            'to.ly' => 'http://to.ly/api.php?longurl=',
                            'to.vg' => 'http://to.vg/api.php?apiusr={login}&apikey={key}&urlquery=',
                            'tra.kz' => 'http://tra.kz/api/shorten?api={key}&l=',
                            'twirl' => 'http://twirl.at/api.php?url=',
                            'twiturl.de' => 'http://api.twiturl.de/friends.php?output=txt&new_url=',
                            'ur.ly' => 'http://ur.ly/new.json?href=',
                            'u.nu' => 'http://u.nu/unu-api-simple?url=',
                            'uiopme' => 'http://uiop.me/api/newlink.php?u=',
                            'unfake.it' => 'http://unfake.it/?a=api&url=',
                            'url.co.uk' => 'http://url.co.uk/api/?ua=Simple+URL+Shortener&key={key}&url=',
                            'urlborg' => 'http://urlborg.com/api/{key}/url/create.xml/',
                            'urlkiss' => 'http://urlkiss.com/api/?x=',
                            'urlshort' => 'http://u.mavrev.com/api.php?url=',
                            'urlg' => 'http://urlg.in/yourls-api.php?action=shorturl&url=',
                            'url.ag' => 'http://url.ag/api.php?create=',
                            'v.gd' => 'http://v.gd/create.php?format=simple&url=',
                            'vb.ly' => 'http://vb.ly/api/?action=shorturl&format=simple&url=',
                            'vl.am' => '#http://vl.am/api/shorten/plain/',
                            'vtc.es' => 'http://vtc.es/create.php?url=',
                            'wapurl' => 'http://wapURL.co.uk//api.cfm?URLToConvert=',
                            'xrl.us' => 'http://metamark.net/api/rest/simple?long_url=',
                            'xr.com' => 'http://api.xr.com/api?link=',
                            'xxsurl' => 'http://xxsURL.de/api.php?url=',
                            'yvy.me' => 'http://yvy.me/api.php?url=',
                            'zi.pe' => 'http://zi.pe/api.php?url=',
                            'zipmyurl' => '#http://zipmyurl.com/api.do?api=true&url=',
                            'z.pe' => 'http://api.z.pe/new.json?href=',
                            'zz.gd' => 'http://zz.gd/api-create.php?url='
                        );

    return $service;
}

/**
* Build XML Array
*
* Function to build array of XML tags for URL extraction
*
* @since	1.2
*
* @return			string	Array of values
*/

function build_xml_array() {

    $xml_convert = array(   'arm.in' => 'arminized_url',
                            '9mp' => 'short',
                            'bit.ly+key' => 'url',
                            'j.mp+key' => 'shortUrl',
                            'min2me' => 'min2me',
                            'minilink' => 'minilink',
                            'retwt.me' => 'shortUrl',
                            'short.ie' => 'shortened',
                            'shw.me' => 'shwme-url',
                            'smse.me' => 'body',
                            'urlborg' => 's_url',
                            'wapurl' => 'wapURL',
                            'xxsurl' => 'shortlink'
                        );

    return $xml_convert;
}

/**
* Build JSON Array
*
* Function to build array of JSON tags for URL extraction
*
* @since	1.2
*
* @return			string	Array of values
*/

function build_json_array() {

    $json_convert = array(  '2zeus' => 'shortcut',
                            'budurl' => 'budurl',
                            'cort.as' => 'urlCortas',
                            'cort.as+key' => 'urlCortas',
                            'durl.me' => 'shortUrl',
                            'ez.com' => 'ezlink',
                            'goo.by' => 'shortUrl',
                            'linkbee' => 'link',
                            'lnk.by' => 'shortUrl',
                            'ndurl' => 'shortURL',
                            'su.pr+key' => 'shortUrl',
                            'tra.kz' => 's',
                            'ur.ly' => 'code',
                            'z.pe' => 'code',
                            'zipmyurl' => 'zipURL'
                        );

    return $json_convert;
}

/**
* Build URL Array
*
* Function to build array of URLs to be appended to the beginning of short codes
*
* @since	1.2
*
* @return			string	Array of values
*/

function build_url_array() {

    $url_addition=array('micurl' => 'http://micurl.com/',
                        'tra.kz' => 'http://tra.kz/',
                        'ur.ly' => 'http://ur.ly/',
                        'z.pe' => 'http://z.pe/',
                        'zipmyurl' => 'http://zipmyurl.com/');

    return $url_addition;
}
?>