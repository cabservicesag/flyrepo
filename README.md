flyrepos
========

*Cause live is to short to build packages*

Fly repos manager (Only distributed systems will survive)


git clone --bare git@publicrepos.com:/login/myrepo.git
cd myrepo.git
git push --mirror git@privaterepos.com:/project/myrepo.git
cd ..
rm -rf myrepo.git
