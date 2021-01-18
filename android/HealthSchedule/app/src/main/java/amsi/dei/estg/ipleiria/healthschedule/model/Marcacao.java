package amsi.dei.estg.ipleiria.healthschedule.model;

public class Marcacao {

    private int id,id_especialidade,id_Utente,id_Medico;
    private String date, tempo;
    private int Aceitar;


    public Marcacao(int id, int id_especialidade, int id_Utente, int id_Medico, String date, String tempo, int aceitar) {
        this.id = id;
        this.id_especialidade = id_especialidade;
        this.id_Utente = id_Utente;
        this.id_Medico = id_Medico;
        this.date = date;
        this.tempo = tempo;
        Aceitar = aceitar;
    }
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_especialidade() {
        return id_especialidade;
    }

    public void setId_especialidade(int id_especialidade) {
        this.id_especialidade = id_especialidade;
    }

    public int getId_Utente() {
        return id_Utente;
    }

    public void setId_Utente(int id_Utente) {
        this.id_Utente = id_Utente;
    }

    public int getId_Medico() {
        return id_Medico;
    }

    public void setId_Medico(int id_Medico) {
        this.id_Medico = id_Medico;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTempo() {
        return tempo;
    }

    public void setTempo(String tempo) {
        this.tempo = tempo;
    }

    public int getAceitar() {
        return Aceitar;
    }

    public void setAceitar(int aceitar) {
        Aceitar = aceitar;
    }
}
