Summary: NethServer clamav scanning tools
%define name nethserver-clamscan
%define version 1.0.4
%define release 1
Name: %{name}
Version: %{version}
Release: %{release}%{?dist}
License: GPL
Source: %{name}-%{version}.tar.gz
# Execute prep-sources to create Source1
Source1:        %{name}.tar.gz
BuildArch: noarch
URL: http://dev.nethserver.org/projects/nethforge/wiki/%{name}
BuildRequires: nethserver-devtools
#AutoReq: no
Requires: nethserver-antivirus
Requires: clamav-scanner-systemd
Requires: nethserver-httpd-admin-service

%description
NethServer clamav scanning tools

%prep
%setup

%post
%preun

%build
%{__mkdir} -p root/var/spool/clamav/quarantine
%{__mkdir} -p root/var/log/clamav/
#mkdir -p root/%{_nsdbconfdir}/{quarantine}/{migrate,force,defaults}
%{makedocs}
perl createlinks
sed -i 's/_RELEASE_/%{version}/' %{name}.json

%install
rm -rf $RPM_BUILD_ROOT
(cd root   ; find . -depth -print | cpio -dump $RPM_BUILD_ROOT)

mkdir -p %{buildroot}/usr/share/cockpit/%{name}/
mkdir -p %{buildroot}/usr/share/cockpit/nethserver/applications/
mkdir -p %{buildroot}/usr/libexec/nethserver/api/%{name}/

tar xvf %{SOURCE1} -C %{buildroot}/usr/share/cockpit/%{name}/

cp -a %{name}.json %{buildroot}/usr/share/cockpit/nethserver/applications/
cp -a api/* %{buildroot}/usr/libexec/nethserver/api/%{name}/
chmod +x %{buildroot}/usr/libexec/nethserver/api/%{name}/*

%{genfilelist} %{buildroot} \
   --dir  /var/spool/clamav/quarantine 'attr(2755,root,root)' \
   --file /sbin/e-smith/nethserver-clamscan 'attr(755,root,root)' \
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)

%dir %{_nseventsdir}/%{name}-update
%doc COPYING
%attr(0440,root,root) /etc/sudoers.d/50_nsapi_nethserver_clamscan

%changelog
* Mon Aug 09 2021 Stephane de Labrusse <stephdl@de-labrusse.fr> 1.0.4-1.ns7
- Recover and add a file to the exclusion list of files/folders
- Change the split validator from \n to ,

* Thu Feb 18 2021 Stephane de Labrusse <stephdl@de-labrusse.fr> 1.0.3-1.ns7
- Requires nethserver-httpd-admin-service

* Mon Aug 10 2020 Stephane de Labrusse <stephdl@de-labrusse.fr> 1.0.2-1.ns7
- Split restore array with ,;,;

* Fri Aug 7 2020 Stephane de Labrusse <stephdl@de-labrusse.fr> 1.0.1-1.ns7
- Forbid the use of `=` in esmith key

* Tue Mar 31 2020 Stephane de Labrusse <stephdl@de-labrusse.fr> 1.0.0-1.ns7
- cockpit UI !!!!

* Tue Oct 15 2019 Stephane de Labrusse <stephdl@de-labrusse.fr> 0.1.3-1.ns7
- cockpit. added to legacy apps

* Sun Mar 11 2017 Stephane de Labrusse <stephdl@de-labrusse.fr>  0.1.2-2-ns7
- GPL license

* Sat Jan 28 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.2-1-ns7
- Scan now is an option in the web gui
- Clamscan applet created
- Before to delete the e-smith db key, we test if the file has been restored

* Wed Jan 25 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.1-1-ns7
- The file restoration can be done in the UI
- clamscan make a e-smith database called quarantine
- Freshclam applet in the dashboard
- Freshclam-update drop the old database before to download the new one

* Sat Jan 21 2017 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.1.0-1-ns7
- Nethserver-clamscan is available for ns7

* Fri Dec 30 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.1-1-ns7
- First release to NS7
