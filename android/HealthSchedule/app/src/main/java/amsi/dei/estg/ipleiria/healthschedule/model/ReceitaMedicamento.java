package amsi.dei.estg.ipleiria.healthschedule.model;

public class ReceitaMedicamento {
    private int id_receita, id_medicamento, quantidade;
    private String posologia;

    public ReceitaMedicamento(int id_receita, int id_medicamento, int quantidade, String posologia) {
        this.id_receita = id_receita;
        this.id_medicamento = id_medicamento;
        this.quantidade = quantidade;
        this.posologia = posologia;
    }

    public int getId_receita() {
        return id_receita;
    }

    public void setId_receita(int id_receita) {
        this.id_receita = id_receita;
    }

    public int getId_medicamento() {
        return id_medicamento;
    }

    public void setId_medicamento(int id_medicamento) {
        this.id_medicamento = id_medicamento;
    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }

    public String getPosologia() {
        return posologia;
    }

    public void setPosologia(String posologia) {
        this.posologia = posologia;
    }
}
