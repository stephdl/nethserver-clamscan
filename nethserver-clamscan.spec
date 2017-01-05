Summary: NethServer clamav scanning tools
%define name nethserver-clamscan
%define version 0.0.1
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

%description
NethServer clamav scanning tools

%prep
%setup

%post
%preun

%build
%{__mkdir} -p root/var/spool/clamav/quarantine
%{makedocs}
perl createlinks

%install
rm -rf $RPM_BUILD_ROOT
(cd root   ; find . -depth -print | cpio -dump $RPM_BUILD_ROOT)

%{genfilelist} %{buildroot} \
  --dir  /var/spool/clamav/quarantine 'attr(0755,clam,clam)' \
$RPM_BUILD_ROOT > e-smith-%{version}-filelist

%clean
rm -rf $RPM_BUILD_ROOT

%files -f e-smith-%{version}-filelist
%defattr(-,root,root)

%dir %{_nseventsdir}/%{name}-update

%changelog

* Fri Dec 30 2016 Stephane de Labrusse <stephdl@de-labrusse.fr> - 0.0.1-1-ns7
- First release to NS7
