flyrepos
========

*Cause live is to short to build packages*

Fly repos manager (Only distributed systems will survive)

## user story

see features/ for further explanation


## flyrepo index standard

	./
	- indexes/
		- exampleindex/
			index.json
				{
					"description": "TYPO3 fly repository - the first the original"
					"repository": "https://github.com/cabservicesag/t3flyrepindex.git"
				}
	- repositories/
		- vendorexample/
			- examplerepository/
				repository.json
					{
						"description": "some very cool repository I like"
						"installpath": "path/relative/to/web/root"
						"repository": "https://github.com/cabservicesag/flyrepos.git"
					}


## Notes
git clone --bare git@publicrepos.com:/login/myrepo.git
cd myrepo.git
git push --mirror git@privaterepos.com:/project/myrepo.git
cd ..
rm -rf myrepo.git
