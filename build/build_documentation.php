<?php

	include('glip/lib/glip.php');
	include('markdown/markdown.php');

	$sGitPath =dirname(dirname(__FILE__))."/";

	$oRepo = new Git($sGitPath.'.git');
	$oMaster_branch = $oRepo->getTip('master');
	$oMaster = $oRepo->getObject($oMaster_branch);
	
	// Pull down the latest documentation
	foreach($oMaster->getTree()->listRecursive() as $sPath => $sSha1) {

		$sTmpPath =dirname(__FILE__) . '/tmp/';
		if(substr($sTmpPath.$sPath, -3) !='.md') { continue; }
		file_exists($sTmpPath.dirname($sPath)) or mkdir($sTmpPath.dirname($sPath) , 0777, true);	
		file_put_contents(substr($sTmpPath.$sPath, 0, -3).'.html', Markdown(file_get_contents($sGitPath.$sPath)));
	}

	echo "done.\n"
?>
