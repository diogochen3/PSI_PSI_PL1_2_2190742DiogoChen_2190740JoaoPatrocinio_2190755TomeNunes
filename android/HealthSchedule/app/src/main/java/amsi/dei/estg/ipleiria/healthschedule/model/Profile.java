package amsi.dei.estg.ipleiria.healthschedule.model;

import java.util.Date;

public class Profile {
    private int id , telefone, nif;
    private String pNome, apelido, email, endereco, genero,postal_code;

    private Date dataNascimento;

    public Profile(int id,  String pNome, String apelido, String email, int telefone,int nif, String endereco, Date dataNascimento, String genero, String postal_code) {
        this.id = id;
        this.telefone = telefone;
        this.nif = nif;
        this.pNome = pNome;
        this.apelido = apelido;
        this.email = email;
        this.endereco = endereco;
        this.genero = genero;
        this.postal_code = postal_code;
        this.dataNascimento = dataNascimento;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getTelefone() {
        return telefone;
    }

    public void setTelefone(int telefone) {
        this.telefone = telefone;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public String getpNome() {
        return pNome;
    }

    public void setpNome(String pNome) {
        this.pNome = pNome;
    }

    public String getApelido() {
        return apelido;
    }

    public void setApelido(String apelido) {
        this.apelido = apelido;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEndereco() {
        return endereco;
    }

    public void setEndereco(String endereco) {
        this.endereco = endereco;
    }

    public String getGenero() {
        return genero;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public String getPostal_code() {
        return postal_code;
    }

    public void setPostal_code(String postal_code) {
        this.postal_code = postal_code;
    }

    public Date getDataNascimento() {
        return dataNascimento;
    }

    public void setDataNascimento(Date dataNascimento) {
        this.dataNascimento = dataNascimento;
    }
}
