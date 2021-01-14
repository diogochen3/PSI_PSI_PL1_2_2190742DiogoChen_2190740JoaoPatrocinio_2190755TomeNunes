package amsi.dei.estg.ipleiria.healthschedule.model;

import java.util.Date;

public class Diagnostico {

private int id,id_medico,id_utente;
private Date date;

private String descricao,situacao;

    public Diagnostico(int id, int id_medico, int id_utente, Date date, String descricao, String situacao) {
        this.id = id;
        this.id_medico = id_medico;
        this.id_utente = id_utente;
        this.date = date;
        this.descricao = descricao;
        this.situacao = situacao;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_medico() {
        return id_medico;
    }

    public void setId_medico(int id_medico) {
        this.id_medico = id_medico;
    }

    public int getId_utente() {
        return id_utente;
    }

    public void setId_utente(int id_utente) {
        this.id_utente = id_utente;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getSituacao() {
        return situacao;
    }

    public void setSituacao(String situacao) {
        this.situacao = situacao;
    }
}
