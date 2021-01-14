package amsi.dei.estg.ipleiria.healthschedule.model;

import java.util.Date;

public class Marcacao {
 private int id,id_Utente,id_Medico,Aceitar;
 private Date date,tempo;

 public Marcacao(int id, int id_Utente, int id_Medico, int aceitar, Date date, Date tempo) {
  this.id = id;
  this.id_Utente = id_Utente;
  this.id_Medico = id_Medico;
  Aceitar = aceitar;
  this.date = date;
  this.tempo = tempo;
 }

 public int getId() {
  return id;
 }

 public void setId(int id) {
  this.id = id;
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

 public int getAceitar() {
  return Aceitar;
 }

 public void setAceitar(int aceitar) {
  Aceitar = aceitar;
 }

 public Date getDate() {
  return date;
 }

 public void setDate(Date date) {
  this.date = date;
 }

 public Date getTempo() {
  return tempo;
 }

 public void setTempo(Date tempo) {
  this.tempo = tempo;
 }
}
