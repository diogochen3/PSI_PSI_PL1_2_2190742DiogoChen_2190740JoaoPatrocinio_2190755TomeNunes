package amsi.dei.estg.ipleiria.healthschedule.model;

public class Consultas {
private int id,id_utente, id_medico;


    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_utente() {
        return id_utente;
    }

    public void setId_utente(int id_utente) {
        this.id_utente = id_utente;
    }

    public int getId_medico() {
        return id_medico;
    }

    public void setId_medico(int id_medico) {
        this.id_medico = id_medico;
    }

    public Consultas(int id, int id_utente, int id_medico) {
        this.id = id;
        this.id_utente = id_utente;
        this.id_medico = id_medico;
    }
}