package amsi.dei.estg.ipleiria.healthschedule.model;

import java.util.Date;

public class Profile {
private int id, Phone_number,NIF,is_medico;
private String First_name,Last_name,Email,Address,postal_code;
private Date Birth_date;

    public Profile(int id, int phone_number, int nif, int is_medico, String first_name, String last_name, String email, String address, String postal_code, Date birth_date) {
        this.id = id;
        Phone_number = phone_number;
        NIF = nif;
        this.is_medico = is_medico;
        First_name = first_name;
        Last_name = last_name;
        Email = email;
        Address = address;
        this.postal_code = postal_code;
        Birth_date = birth_date;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getPhone_number() {
        return Phone_number;
    }

    public void setPhone_number(int phone_number) {
        Phone_number = phone_number;
    }

    public int getNIF() {
        return NIF;
    }

    public void setNIF(int NIF) {
        this.NIF = NIF;
    }

    public int getIs_medico() {
        return is_medico;
    }

    public void setIs_medico(int is_medico) {
        this.is_medico = is_medico;
    }

    public String getFirst_name() {
        return First_name;
    }

    public void setFirst_name(String first_name) {
        First_name = first_name;
    }

    public String getLast_name() {
        return Last_name;
    }

    public void setLast_name(String last_name) {
        Last_name = last_name;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String email) {
        Email = email;
    }

    public String getAddress() {
        return Address;
    }

    public void setAddress(String address) {
        Address = address;
    }

    public String getPostal_code() {
        return postal_code;
    }

    public void setPostal_code(String postal_code) {
        this.postal_code = postal_code;
    }

    public Date getBirth_date() {
        return Birth_date;
    }

    public void setBirth_date(Date birth_date) {
        Birth_date = birth_date;
    }
}
