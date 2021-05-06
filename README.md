## Pr00filer Website

The proofiler website allows you to view statistics on all the analyses performed by the white station fleet. In addition, it also allows administrators to configure the white stations remotely and centrally.

## To-do list

### Project Basis

- [x] Base development
- [x] Database creation

### Unauthenticated part

- [ ] Displaying the number of scans that have detected viruses in relation to the total number of scans
- [ ] Displaying the number of scanned files
- [ ] Displaying the number of detected viruses
- [ ] Displaying the most detected viruses
- [ ] Display of the number of viruses detected and scan performed per month
- [ ] Displaying the average time of a scan

### Authenticated part

- [x] Login page development
- [x] Session management
- [ ] Displaying the USBs flash drives containing the most viruses
- [x] Retrieve data from stations
- [ ] Send configuration to stations
- [ ] Encrypt exchanges between the server and the stations
- [x] Send an email to pr00filer@localhost every hour to report detected virus (with crontab)
- [x] CRUD admins
- [x] CRUD extensions
- [x] CRUD stations
- [x] CRUD employees
- [x] CRUD USBs
- [x] CRUD scans
- [x] CRUD viruses
