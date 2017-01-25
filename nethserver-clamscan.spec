Summary: NethServer clamav scanning tools
%define name nethserver-clamscan
%define version 0.1.1
%define release 1
Name: %{name}
Version: %{version}
Release: %{release}%{?dist}
License: GPL
Source: %{name}-%{version}.tar.gz
BuildArch: noarch
URL: http://dev.nethserver.org/projects/nethforge/wiki/%{name}
BuildRequires: nethserver-devtools
#AutoReq: no
Requires: nethserver-antivirus
Requires: clamav-scanner-systemd

%description
NethServer clamav scanning tools

%prep
%setup

%post
#upgrade clamav database following the installation
if [ $1 -eq 1 ] ; then
/sbin/e-smith/expand-template /etc/freshclam.conf
/usr/libexec/nethserver/freshclam-nethgui &
fi
%preun

%build
%{__mkdir} -p root/var/spool/clamav/quarantine
%{__mkdir} -p root/var/log/clamav/
#mkdir -p root/%{_nsdbconfdir}/{quarantine}/{migrate,force,defaults}
%{makedocs}
perl createlinks

%install
rm -rf $RPM_BUILD_ROOT
(cd root   ; find . -depth -print | cpio -dump $RPM_BUILD_ROOT)

%{genfilelist} %{buildroot} \
   --dir  /var/spool/clamav/quarantine 'attr(2755,root,root)' \
   --file /sbin/e-smith/nethserver-clamscan 'attr(755,root,root)' \
   --file /usr/libexec/nethserver/freshclam-nethgui 'attr(755,root,root)' \
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)

%dir %{_nseventsdir}/%{name}-update
#%dir %{_nsdbconfdir}/quarantine

%changelog
* Wed Jan 25 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.1-1-ns7
- The file restoration can be done in the UI
- clamscan make a e-smith database called quarantine
- Freshclam applet in the dashboard
- Freshclam-update drop the old database before to download the new one

* Sat Jan 21 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.0-1-ns7
- Nethserver-clamscan is available for ns7

* Fri Dec 30 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.1-1-ns7
- First release to NS7
